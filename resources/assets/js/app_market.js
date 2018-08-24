require("./bootstrap");

window.Vue = require("vue");

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

const app = new Vue({
    el: "#app",
    data: {
        poste:"",
        name:"",
        price:"20",
        club:"Agen",
        players:Array,
        loading:false,
        page_up : 1,
        page:0,
        page_max:0,
        target:null,
        target_id:0,
        modalShow:false,
        mobile:false,
    },

    mounted ()
    {
        this.GetPlayerList();
        AppendDeleteButton(this);

    },
    methods: {
        GetPlayerList : function ()
        {
          var root = this;
          this.players = null;
          AddSpinner($("#table_loading"));
          $.ajax({
            url: '/GetPlayerList',
                type: 'POST',
                data: {
                  name:root.name,
                  club:root.club,
                  price:root.price,
                  poste:root.poste,
                  page:root.page,
                },

                dataType: 'JSON',
                success: function (data) {
                    if(data.players != null)
                    {
                        root.players = data.players;
                    }
                    console.log(data.compo.players);
                    if(data.compo != null)
                    {
                        for (var i = 0; i < root.players.length; i++) {
                            if(String(data.compo.players).includes(root.players[i].name))
                            {
                                root.players[i].have = true;
                            }
                            else {
                                root.players[i].have = false;
                            }
                        }
                        root.loading = true;
                        RemoveSpinner();
                    }
                },
                error: function (e) {
                    console.log(e.responseText);
                }
            });
          this.GetPagination();
          this.page = 0;
        },
        GetPagination : function ()
        {
          var root = this;
          $.ajax({
            url: '/GetPagination',
                type: 'POST',
                data: {
                  poste: root.poste,
                  name: root.name,
                  club: root.club,
                  page_up:root.page_up
                },

                dataType: 'JSON',
                success: function (data) {
                    if(data != null)
                    {
                        root.page_max = data.max;
                    }
                },
                error: function (e) {
                    console.log(e.responseText);
                }
            });
          this.page_up = 1;
        },
        PaginationUp : function (event)
        {
            this.$refs.next.hidden = false;
            this.page = event.target.innerText;
            this.GetPlayerList();
        },
        PaginationAfter : function ()
        {
            this.$refs.next.hidden = false;
            if(this.page_up >= 1)
            {
              this.page_up = this.page_up - 5;
              this.page = this.page_up - 1;
              this.GetPlayerList();
              this.GetPagination();
            }
        },
        PaginationNext : function()
        {
            this.page_up = this.page_up + 5;
            if(this.page_up >= this.page_max)
            {
                this.page = this.page_max;
                this.$refs.next.hidden = true;
            }
            else {
              this.page = this.page_up;
            }
            this.$refs.next.hidden = false;
            for (var i = this.page_up; i < this.page_up + 5; i++) {
                  if(i > this.page_max)
                  {

                      break;
                  }
            }
            this.GetPlayerList();
            this.GetPagination();
        },
        TargetPoste : function (id, event)
        {
            this.$refs.poste.innerText = GetIdbyPost(parseInt(id));
            this.poste = GetIdbyPost(parseInt(id));
            this.target = event.target;
            this.target_id = parseInt(id);
            this.GetPlayerList();
        },
        BuyPlayer: function(pl)
        {
            var id_t = GetIdbyPost(this.poste);

            var identifier = this.GetPlayerId(pl);
            if(pl.have == true)
            {
                this.ShowModal("Information","Vous avez deja ce joueur dans votre équipe !!");
                return;
            }
            if(this.target != null)
            {
                var root = this;
                $.ajax({
                  url: '/BuyPlayer',
                      type: 'POST',
                      data: {
                        poste: GetIdbyPost(parseInt(root.target_id)),
                        name: pl.name,
                        id: parseInt(root.target_id),
                      },

                      dataType: 'JSON',
                      success: function (data) {
                          if(data.player != null)
                          {
                              if(root.mobile == false)
                              {
                                var el = $('<div @click="DeletePlayer" class="delete-player"><i class="fas fa-trash"></i></div>');
                                $("body").on("click",".delete-player", root.DeletePlayer);
                                $(root.target).append(el);

                                var url = "url(/images/"+data.player.club+".png)";
                                $(root.target).css("background-image",url);

                                $(".player-info label",root.target).text(data.player.name);
                                UpdateMoney(data.money);
                                pl.have = true;
                                $( ".player-selected" ).each(function( index ) {
                                    if(index == identifier)
                                    {
                                        $(this).css("background","#5fd079");
                                        return;
                                    }
                                });
                              }
                              if(root.mobile == true)
                              {
                                  ReloadPage();
                                  root.mobile = false;
                              }
                          }

                      },
                      error: function (e) {
                          root.ShowModal("Information",e.responseText);
                      }
                  });
            }
        },
        GetPlayerId: function (pl)
        {
            for (var i = 0; i < this.players.length; i++) {
                if(this.players[i] == pl)
                {
                    return i;
                }
            }
        },
        ShowModal: function(title,content)
        {
            this.modalShow = true;
            this.$refs.title_modal.innerText  = title;
            this.$refs.content_modal.innerText  = content;
        },
        CloseModal: function ()
        {
          this.modalShow = false;
          this.$refs.title_modal.innerText  = "Information";
          this.$refs.content_modal.innerText  = "";
          if(this.mobile == true)
          {
              ReloadPage();
              this.mobile = false;
          }
        },
        DeletePlayer: function (event)
        {
          var parent = $(event.target).closest(".players");
          var name_t = $(parent,".player-info").text();
          var root = this;
          $.ajax({
            url: '/DeletePlayer',
                type: 'POST',
                dataType: 'JSON',
                data: {
                  name:name_t
                },
                success: function (data) {
                    $(parent).css("background-image","url(/images/player_add.png)");
                    if(data.poste != null)
                    {
                        $(".player-info label",parent).text(data.poste);
                    }
                    $(event.target).remove();
                    UpdateMoney(data.money);
                },
                error: function (e) {
                    console.log(e.responseText);
                }
            });
        },
        DeletePlayerMobile: function (event)
        {
            var parent = $(event.target).closest(".list-group-item ");
            var name_t = $(".mobile-info_player",parent).text();
            AddSpinner(parent);
            $.ajax({
              url: '/DeletePlayer',
                  type: 'POST',
                  data: {
                    name:name_t
                  },
                  success: function (data) {
                      ReloadPage();
                  },
                  error: function (e) {
                      console.log(e.responseText);
                  }
              });
        },
        TargetPosteMobile: function(id, event)
        {
            this.$refs.poste.innerText = GetIdbyPost(parseInt(id));
            this.poste = GetIdbyPost(parseInt(id));
            this.target = event.target;
            this.target_id = parseInt(id);
            this.GetPlayerList();
            this.mobile = true;

            $("#mobile-list").hide();
            $("#player-market").show();
        }
    }
});

function AddSpinner (el)
{
    $(el).append('<i class="fa fa-spinner fa-spin loading-spin"></i>');
}
function RemoveSpinner()
{
    $(".loading-spin").remove();
}
function ReloadPage ()
{
    location.reload();
}
function GetListAllPlayer(name_t,post_t,page_t,club_t,price)
{

}
function GetIdbyPost (id)
{
  switch (id)
  {
    case 0:
        return "Arrière";
    break;

    case 1:
        return "Ailier";
    break;

    case 2:
        return "Centre";
    break;

    case 3:
        return "Centre";
    break;

    case 4:
        return "Ailier";
    break;

    case 5:
        return "Ouverture";
    break;

    case 6:
        return "Melée";
    break;

    case 7:
        return "3emeligne";
    break;

    case 8:
        return "3emeligne";
    break;

    case 9:
        return "3emeligne";
    break;

    case 10:
        return "2emeligne";
    break;

    case 11:
        return "2emeligne";
    break;

    case 12:
        return "Pilier";
    break;

    case 13:
        return "Talonneur";
    break;

    case 14:
        return "Pilier";
    break;
  }
}
function DetectisPlayer (id)
{
  switch (id)
  {
    case "Arrière":
        return true;
    break;

    case "Ailier":
        return true;
    break;

    case "Centre":
        return true;
    break;

    case "Ouverture":
        return true;
    break;

    case "Melée":
        return true;
    break;

    case "3emeligne":
        return true;
    break;

    case "2emeligne":
        return true;
    break;


    case "Pilier":
        return true;
    break;

    case "Talonneur":
        return true;
    break;
    default:
        return false;
    break;
  }
}
function UpdateMoney (money)
{
    $(".budget").text("Mon Budget:"+money);
}
function AppendDeleteButton(root)
{
  $( document ).ready(function() {
    $( ".players" ).each(function( index ) {
      var el = $('<div @click="DeletePlayer" class="delete-player"><i class="fas fa-trash"></i></div>');
      var name = this.children[0].innerText;
      if(DetectisPlayer(name) == false)
      {
            $(this).append(el);
      }
    });
    $("#all_terrain").on("click",".delete-player", root.DeletePlayer);
  });
}

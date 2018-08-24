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
        ShowJoin:false,
        ShowCreate:false,
        ShowLeague:false,
        select:null,
        create_name:"",
        create_max:"2",
        modalShow:false,
        icon:"",
        token_league:"",
        owner_quit:false,
        send_email:"",
    },
    mounted ()
    {
        AddSpinner($("body"));
        this.DetectHaveLeague();
    },
    methods: {
        ShowJoinLeague: function()
        {
            this.ShowJoin = true;
            this.ShowCreate = false;
            this.ShowLeague = false;
        },
        ShowCreateLeague: function ()
        {
          this.ShowJoin = false;
          this.ShowCreate = true;
          this.ShowLeague = false;
        },
        ShowBlockLeague: function ()
        {
          this.ShowJoin = false;
          this.ShowCreate = false;
          this.ShowLeague = true;
        },
        SelectBaniere:function (icon,event)
        {
            $(this.select).css("border","none");
            var parent = $(event.target).closest('.banier-el');
            $(parent).css("border","solid 3px #00a7ff");
            this.select = parent;
            this.icon = icon;
        },
        DetectHaveLeague:function()
        {
            var root = this;
            $.ajax({
            url: '/GetMyLeague',
                type: 'POST',
                data: {
                },
                success: function (data) {
                  if(data != "")
                  {
                    root.ShowJoin = false;
                    root.ShowCreate = false;
                    root.ShowLeague = true;

                  }
                  else {
                    root.ShowJoin = true;
                    root.ShowCreate = false;
                    root.ShowLeague = false;
                  }
                  RemoveSpinner();
                },
                error: function (e) {

                }
            });
        },
        QuitLeagueOwner: function()
        {
            this.owner_quit = true;
            this.ShowModalMessage("Voulez vous vraiment quitter cette league ?","Voullez vous quittez votre league car vous étes le propriétaire.Si vous quittez votre league, le nouveau propriétaire sera choisit en fonction des membres actuels la league.Mais si il n'y a aucun membres dans votre league,elle saura supprimer.");

        },
        QuitLeague:function()
        {
            var root = this;
            $.ajax({
            url: '/QuitMyLeague',
                type: 'POST',
                data: {
                },
                success: function (data) {
                  location.reload();
                },
                error: function (e) {

                }
            });
        },
        CreateLeague: function ()
        {
            var root = this;
            var color_t = $(root.select).css("background-color");
            $.ajax({
            url: '/CreateLeague',
                type: 'POST',
                data: {
                  name: root.create_name,
                  max: root.create_max,
                  icon: root.icon,
                  color: color_t
                },
                success: function (data) {
                    if(data.errors != null)
                    {
                        var message = "";
                        for (var i = 0; i < data.errors.length; i++) {
                            message += data.errors[i] + "\n";
                            root.ShowModalMessage("Erreur",message,"red");
                        }
                    }
                    else {
                        root.ShowModalMessage("Information",data,"green");
                        location.reload();
                    }
                },
                error: function (e) {

                }
            });
        },
        JoinLeague: function()
        {
            var root = this;
            $.ajax({
            url: '/JoinLeague',
                type: 'POST',
                data: {
                  token: root.token_league,
                },
                success: function (data) {
                    if(data.errors != null)
                    {
                        var message = "";
                        for (var i = 0; i < data.errors.length; i++) {
                            message += data.errors[i] + "\n";
                            root.ShowModalMessage("Erreur",message,"red");
                        }
                    }
                    else {
                        console.log(data);
                        root.ShowModalMessage("Information",data,"green");
                        location.reload();
                    }
                },
                error: function (e) {

                }
            });
        },
        ShowModalMessage: function(title,message,color)
        {
            this.$refs.content_modal.innerText = "";
            this.$refs.title_modal.innerText = "";
            $(this.$refs.content_modal).text("");

            $(this.$refs.content_modal).css("color","black");
            if(color != null)
            {
                $(this.$refs.content_modal).css("color",color);
            }

            this.$refs.title_modal.innerText = title;
            this.$refs.content_modal.innerText = message;

            $(this.$refs.league_footer).html("");
            if(this.owner_quit == true)
            {
                var el = $('<button type="button" class="btn btn-warning close-yes-woner" data-dismiss="modal" >Oui</button>');
                var el1 = $('<button type="button" class="btn btn-primary close-p" data-dismiss="modal">Non</button>');
                $(".modal-vue").on("click",".close-p", this.CloseModal);
                $(".modal-vue").on("click",".close-yes-woner", this.QuitLeague);
                $(this.$refs.league_footer).append(el);
                $(this.$refs.league_footer).append(el1);
            }
            else {
              var el = $('<button type="button" class="btn btn-primary close-p" data-dismiss="modal">Fermer</button>');
              $(".modal-vue").on("click",".close-p", this.CloseModal);
              $(this.$refs.league_footer).append(el);
            }
            this.modalShow = true;
            this.owner_quit = false;
        },
        SendCodeLeague : function()
        {
          var root = this;
          $.ajax({
          url: '/SendMailLeague',
              type: 'POST',
              data: {
                email: root.send_email,
              },
              success: function (data) {
                  if(data.errors != null)
                  {
                      var message = "";
                      for (var i = 0; i < data.errors.length; i++) {
                          message += data.errors[i] + "\n";
                          root.ShowModalMessage("Erreur",message,"red");
                      }
                  }
                  else {
                      root.ShowModalMessage("Information",data,"green");
                      root.send_email = "";
                  }
              },
              error: function (e) {

              }
          });
        },
        CloseModal:function ()
        {
            this.modalShow = false;
            this.$refs.title_modal = "Information";
            this.$refs.content_modal = "";
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

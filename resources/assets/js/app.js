require("./bootstrap");

window.Vue = require("vue");


Vue.component("player-table", require("./components/TablePlayerSelect.vue"));
Vue.component("player-row", require("./components/RowPlayerSelect.vue"));

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
const app = new Vue({
    el: "#app",
    data: {
      choice_state: false,
      target_club:"Agen",
      date:"",
      heures:"Heures",
      minutes:"Minutes",
      modalShow: false,
      modalTitle:"",
      scored:false,
      score:0
    },
    mounted ()
    {
        this.GetSavePlayers();
    },
    methods: {
       OpenMenu: function (element) {
          this.choice_state = true;
          this.$children[0].getplayerList(element);
       },
       ClubChange:function()
       {
          this.GetSavePlayers();
       },
       UpdateDate: function (event)
       {
          if(this.minutes != "Minutes" && this.heures != "Heures")
          {
            this.date = this.$refs.date.value + " " + this.heures +":"+this.minutes;
            axios.post("/AdminDeadLine" ,{
                deadline: this.date
            }).then((result) => {
                this.ModalShowInfo("Information",result.data);
            })
          }
          if(this.minutes == "Minutes" && this.heures == "Heures")
          {
              this.ModalShowInfo("Information","vous devez remplir les 2 champs minutes et heures.");
          }
       },
       CalculEquipe: function ()
       {
         var list = {rows:[],score1:this.$refs.score1.value,score2:this.$refs.score2.value,dom:this.scored};
         for (var i = 1; i < this.$children.length; i++) {
             var name_p = this.$children[i].$refs.name.value;
             var equipe_p  = this.$children[i].$refs.equipe.innerText;
             var poste_p  = this.$children[i].$refs.poste.innerText;
             var minutes_p  = this.$children[i].$refs.minutes.value;
             var score_p  = this.$children[i].$refs.score.innerText;
             var essais_p  = this.$children[i].$refs.essais.value;
             var penalites_p  = this.$children[i].$refs.penalites.value;
             var drops_p  = this.$children[i].$refs.drops.value;
             var cartonj_p  = this.$children[i].$refs.cartonj.value;
             var cartonr_p  = this.$children[i].$refs.cartonr.value;
             var total_p  = this.$children[i].$refs.total.innerText;
             if(name_p == "")
             {
                  this.ModalShowInfo("Information","Equipe non valide champs vide");
                  return;
             }
             var pl = {name:name_p ,equipe:equipe_p ,poste:poste_p,minutes:minutes_p,score:score_p,essais:essais_p,penalites:penalites_p,drops:drops_p,cartonj:cartonj_p,cartonr:cartonr_p,total:total_p};
             list.rows.push(pl);
         }
         this.ModalShowInfo("Information","Le tableaux a été sauvgarder");
         var root = this;
         $.ajax({
         url: '/SetAdminSaveCunter',
             type: 'POST',
             data: {
               players:list,
               club:root.target_club
             },
             success: function (data) {

             },
             error: function (e) {
                console.log(e);
             }
         });
       },
       GlobalCalcul: function ()
       {
         var root = this;
         $.ajax({
         url: '/GlobalCalcul',
             type: 'POST',
             data: {
             },
             success: function (data) {
                  console.log(data);
             },
             error: function (e) {
                console.log(e);
             }
         });
       },
       GetSavePlayers: function ()
       {
           var root = this;
           $.ajax({
           url: '/GetSavePlayers',
               type: 'POST',
               data: {
                 club:root.target_club
               },
               success: function (data) {
                  if(data != null && data != "")
                  {
                      var rows = JSON.parse(data).rows;
                      var r = 1;
                      for (var i = 0; i < rows.length; i++) {
                        root.$children[r].$refs.name.value = rows[i].name;
                        root.$children[r].$refs.equipe.innerText = rows[i].equipe;
                        root.$children[r].$refs.poste.innerText = rows[i].poste;
                        root.$children[r].$refs.minutes.value = rows[i].minutes;
                        root.$children[r].$refs.score.innerText = rows[i].score;
                        root.$children[r].$refs.essais.value = rows[i].essais;
                        root.$children[r].$refs.penalites.value = rows[i].penalites;
                        root.$children[r].$refs.drops.value = rows[i].drops;
                        root.$children[r].$refs.cartonj.value = rows[i].cartonj;
                        root.$children[r].$refs.cartonr.value = rows[i].cartonr;
                        root.$children[r].$refs.total.innerText = rows[i].total;

                        root.$children[r]._data.score = rows[i].score;
                        root.$children[r]._data.minutes = rows[i].minutes;
                        root.$children[r]._data.essais = rows[i].essais;
                        root.$children[r]._data.penalites = rows[i].penalites;
                        root.$children[r]._data.drops = rows[i].drops;
                        root.$children[r]._data.cartonj = rows[i].cartonj;
                        root.$children[r]._data.cartonr = rows[i].cartonr;
                        root.$children[r]._data.total = rows[i].total;
                        root.scored = JSON.parse(data).dom;
                        root.$refs.score1.value = JSON.parse(data).score1;
                        root.$refs.score2.value = JSON.parse(data).score2;
                        r++;
                      }
                  }
                  else {
                    for (var i = 1; i <= 15; i++) {
                      if(i != 0)
                      {
                          root.$children[i].$refs.name.value = "";
                          root.$children[i].$refs.equipe.innerText = "";
                          root.$children[i].$refs.poste.innerText = "";
                          root.$children[i].$refs.minutes.value = "";
                          root.$children[i].$refs.score.innerText = "";
                          root.$children[i].$refs.essais.value = "";
                          root.$children[i].$refs.penalites.value = "";
                          root.$children[i].$refs.drops.value = "";
                          root.$children[i].$refs.cartonj.value = "";
                          root.$children[i].$refs.cartonr.value = "";
                          root.$children[i].$refs.total.innerText = "";
                      }
                    }
                  }
               },
               error: function (e) {
                  console.log(e);
               }
           });
       },
       ModalShowInfo: function(title,message)
       {
          this.modalShow = true;
          this.$refs.title.innerText = title;
          this.$refs.message.innerText = message;
       },
       CloseModal: function()
       {
          this.modalShow = false;
       },
       ClosePanel: function ()
       {
          this.choice_state = false;
       },
       CheckIsValid : function(name)
       {
          for (var i = 1; i < this.$children.length; i++) {
              if(this.$children[i].$refs.name.value == name)
              {
                  this.ModalShowInfo("Information","Ce nom est déja utilisé dans un champs !!!");
                  return true;
              }
          }
          return false;
       },
       UpdateRowScore : function()
       {
          for (var i = 1; i < this.$children.length; i++) {
              this.$children[i].$refs.score.innerText = this.score;
              this.$children[i]._data.score = this.score;
          }
       },
       UpdateScore: function ()
       {
          var total = 0;
          var score1 = this.$refs.score1.value;
          var score2 = this.$refs.score2.value;
          if(parseInt(score1) > parseInt(score2) && this.scored == true)
          {
              total = 18;
              total += Math.abs((parseInt(score1) - parseInt(score2))) * 0.5;
          }
          if(parseInt(score1) > parseInt(score2) && this.scored == false)
          {
              total = 24;
              total += Math.abs((parseInt(score1) - parseInt(score2))) * 0.5;
          }
          if(parseInt(score1) == parseInt(score2) && this.scored == true)
          {
              total = 10;
          }
          if(parseInt(score1) == parseInt(score2) && this.scored == false)
          {
              total = 16;
          }
          if(parseInt(score1) < parseInt(score2) && this.scored == true)
          {
              total = 2;
              total -= Math.abs((parseInt(score1) - parseInt(score2))) * 0.5;
          }
          if(parseInt(score1) < parseInt(score2) && this.scored == false)
          {
              total = 4;
              total -= Math.abs((parseInt(score1) - parseInt(score2))) * 0.5;
          }
          this.score = total;
          this.UpdateRowScore();
       }
    }
});

require("./bootstrap");

window.Vue = require("vue");


const app = new Vue({
    el: "#app",
    data: {
        poste:"Arrière",
        name:"",
        price:"",
        club:"Agen"
    },

    methods: {
        AddPlayer : function ()
        {
          axios.post("/AddPlayerAdmin", {
             poste: this.poste,
             name: this.name,
             club: this.club,
             price: this.price,
          }).then((result) => {
              this.price = "";
              this.name = "";
          })
        }
    }
});

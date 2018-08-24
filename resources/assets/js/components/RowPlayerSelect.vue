<template>
  <tr>
    <td ><input type="text" class="form-control" placeholder="Nom Joueur" v-on:click="OpenMenu" ref="name"></td>
    <td><label   ref="equipe"></label></td>
    <td><label   ref="poste"></label></td>
    <td><input type="text" class="form-control" placeholder="0"  v-model="minutes" ref="minutes"></td>
    <td><label ref="score">0</label></td>
    <td><label><input type="text" class="form-control" placeholder="0" v-model="essais" ref="essais"></label></td>
    <td><label><input type="text" class="form-control" placeholder="0" v-model="penalites" ref="penalites"></label></td>
    <td><label><input type="text" class="form-control" placeholder="0" v-model="drops" ref="drops"></label></td>
    <td><label><input type="text" class="form-control" placeholder="0" v-model="cartonj" ref="cartonj"></label></td>
    <td><label><input type="text" class="form-control" placeholder="0" v-model="cartonr" ref="cartonr"></label></td>
    <td><label ref="total">0</label></td>
  </tr>
</template>

<script>
    export default {

        data() {
          return {
              minutes: "",
              essais: "",
              penalites: "",
              drops:"",
              cartonr:"",
              cartonj:"",
              score:""
          }
        },
        watch: {
          minutes: function(val) {
              if(val == 0)
              {
                  this.$refs.total.innerText = AllCalculate(this._data);
              }
              if(isInt(parseInt(this.minutes)) === true && val >= 0 && val <= 80)
              {
                  this.$refs.total.innerText = AllCalculate(this._data);
              }
          },
          essais: function(val) {
              if(val == 0)
              {
                  this.$refs.total.innerText = AllCalculate(this._data);
              }
              if(isInt(parseInt(this.essais)) === true && val >= 0)
              {
                  this.$refs.total.innerText = AllCalculate(this._data);
              }
          },
          penalites: function(val) {
              if(val == 0)
              {
                  this.$refs.total.innerText = AllCalculate(this._data);
              }
              if(isInt(parseInt(this.penalites)) === true && val >= 0)
              {
                  this.$refs.total.innerText = AllCalculate(this._data);
              }
          },
          drops: function(val) {
              if(val == 0)
              {
                  this.$refs.total.innerText = AllCalculate(this._data);
              }
              if(isInt(parseInt(this.drops)) === true && val >= 0)
              {
                  this.$refs.total.innerText = AllCalculate(this._data);
              }
          },
          cartonr: function(val) {
              if(val == 0)
              {
                  this.$refs.total.innerText = AllCalculate(this._data);
              }
              if(isInt(parseInt(this.cartonr)) === true && val >= 0)
              {
                  this.$refs.total.innerText = AllCalculate(this._data);
              }
          },
          cartonj: function(val) {
              if(val == 0)
              {
                  this.$refs.total.innerText = AllCalculate(this._data);
              }
              if(isInt(parseInt(this.cartonj)) === true && val >= 0)
              {
                  this.$refs.total.innerText = AllCalculate(this._data);
              }
          }
        },
        methods: {
            OpenMenu: function ()
            {
                this.$parent.OpenMenu(this);
            },
            updateInfo: function (name,club,poste)
            {
                this.$refs.equipe.innerText = club;
                this.$refs.name.value = name;
                this.$refs.poste.innerText = poste;

                this.$parent.ClosePanel();
            },
        },
    }
    function isInt(value) {
      if (isNaN(value)) {
        return false;
      }
      var x = parseFloat(value);
      return (x | 0) === x;
    }
    function AllCalculate (table)
    {
        var score = parseInt(table.score) || 0;
        var minutes = parseInt(table.minutes) || 0;
        var essais = parseInt(table.essais) * 15 || 0;
        var penalites = parseInt(table.penalites) * 2 || 0;
        var drops = parseInt(table.drops) * 5 || 0;
        var cartonj = parseInt(table.cartonj) * -3 || 0;
        var cartonr = parseInt(table.cartonr) * -5 || 0;

        var total = 0;
        total = score +essais + penalites + drops + cartonj + cartonr;
        total = total * ( minutes/80);
        return Math.round(total);
    }
</script>

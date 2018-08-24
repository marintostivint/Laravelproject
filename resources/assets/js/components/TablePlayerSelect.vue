<template>
<div>
  <button type="button" class="btn btn-primary" v-on:click="GoBack">Retour en arrière</button>
  <div class="form-row">
    <div class="col-lg-4">
      <input type="text"  class="form-control" placeholder="Nom du joueur recherché"  v-on:change="getplayerList">
    </div>
    <div class="col-sm-4">
      <select class="custom-select" v-model="target_poste" v-on:change="getplayerList">
        <option>Arrière</option>
        <option>Ailier</option>
        <option>Centre</option>
        <option>Ouverture</option>
        <option>Melée</option>
        <option>3emeligne</option>
        <option>2emeligne</option>
        <option>Pilier</option>
        <option>Talonneur</option>
       </select>
    </div>
  </div>
  <table class="table table-hover" >

    <thead class="text-primary">
      <th>ID</th>
      <th>Nom</th>
      <th>Club</th>
      <th>Poste</th>
    </thead>
    <tbody>
    <tr v-for="(pl, index) in players" v-on:click="Selecting(index)">
      <th scope="row">{{index}}</th>
      <td>{{pl.name}}</td>
      <td>{{pl.club}}</td>
      <td>{{pl.poste}}</td>
    </tr>
    </tbody>
  </table>
  <h2  v-if="errors.length > 0 " class="text-center text-danger " >Aucun joueur disponible</h2>
</div>
</template>

<script>
    export default {

        data() {
          return {
            players: [],
            target_club: "",
            target_poste: "Arrière",
            errors : "",
            target:null,
          }
        },


        methods: {
          getplayerList(element)
          {
              this.errors = "";
              this.target_club = this.$parent.target_club;

              axios.post("/GetAdminPlayerList", {
                 club: this.target_club,
                 poste: this.target_poste,
              }).then((result) => {
                  if(result != null && result.data.players != null)
                  {
                      this.players = result.data.players;
                  }
                  if(result != null && result.data.players.length == 0)
                  {
                      this.errors = "Une erreur c'est produite";
                  }
              })
              if(element!= null&&element.$refs.name != null)
              {
                  this.target = element;
              }
              PageUp();
          },
          Selecting: function(index)
          {
              if(this.$parent.CheckIsValid(this.players[index].name) == false)
              {
                  this.target.updateInfo(this.players[index].name,this.players[index].club,this.players[index].poste);
              }
          },
          GoBack : function ()
          {
                this.$parent.ClosePanel();
          }
        },
    }
    function PageUp ()
    {
        $('#app').scrollTop(0);
    }
</script>

@include('navbar')
@inject('market', "App\Utility\SimplifyEquipe")
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  </head>
  <body>
    <div id="app" >
    <div class="container" >
      <div class="modal-vue" tabindex="-1" role="dialog" v-show="modalShow" style="display:none">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" ref="title_modal">Information</h5>
              <button type="button" class="close close-p" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" v-on:click="CloseModal">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p ref="content_modal"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary close-p" data-dismiss="modal" v-on:click="CloseModal">Fermer</button>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-md-center " style="margin-top:60px">
        <div class="col col-lg-8" id="all_terrain">
          <div class="counter"><ul class="countdown"></ul></div>
          <button type="button" class="btn btn-primary" id="save-players" class="save_pl">Sauvegarder </button>
          <div id="budget" class="">
            <center><h5 id="money" class="budget">Mon budget:{{$market->GetMoney()}}</h5></center>
          </div>
          <div id="terrain">
            <div class="player-line">
              <div class="players" style="background-image:{{$market->GetPostByIdImage(0)}}" v-on:click="TargetPoste('0', $event)">
                  <div class="player-info" >
                    <label>{{$market->GetPostById(0)}}</label>
                  </div>
              </div>
            </div>
            <div class="player-line">
              <div class="players" style="background-image:{{$market->GetPostByIdImage(1)}}" v-on:click="TargetPoste('1', $event)">
                  <div class="player-info">
                    <label>{{$market->GetPostById(1)}}</label>
                  </div>
              </div>
              <div class="players" style="background-image:{{$market->GetPostByIdImage(2)}}" v-on:click="TargetPoste('2', $event)">
                  <div class="player-info">
                    <label>{{$market->GetPostById(2)}}</label>
                  </div>
              </div>
              <div class="players" style="background-image:{{$market->GetPostByIdImage(3)}}" v-on:click="TargetPoste('3', $event)">
                  <div class="player-info">
                    <label>{{$market->GetPostById(3)}}</label>
                  </div>
              </div>
              <div class="players" style="background-image:{{$market->GetPostByIdImage(4)}}" v-on:click="TargetPoste('4', $event)">
                  <div class="player-info">
                    <label>{{$market->GetPostById(4)}}</label>
                  </div>
              </div>
            </div>
            <div class="player-line">
              <div class="players" style="background-image:{{$market->GetPostByIdImage(5)}}" v-on:click="TargetPoste('5', $event)">
                  <div class="player-info">
                    <label>{{$market->GetPostById(5)}}</label>
                  </div>
              </div>
              <div class="players" style="background-image:{{$market->GetPostByIdImage(6)}}" v-on:click="TargetPoste('6', $event)">
                  <div class="player-info">
                    <label>{{$market->GetPostById(6)}}</label>
                  </div>
              </div>
            </div>
            <div class="player-line">
              <div class="players" style="background-image:{{$market->GetPostByIdImage(7)}}" v-on:click="TargetPoste('7', $event)">
                  <div class="player-info">
                    <label>{{$market->GetPostById(7)}}</label>
                  </div>
              </div>
              <div class="players" style="background-image:{{$market->GetPostByIdImage(8)}}" v-on:click="TargetPoste('8', $event)">
                  <div class="player-info">
                    <label>{{$market->GetPostById(8)}}</label>
                  </div>
              </div>
              <div class="players" style="background-image:{{$market->GetPostByIdImage(9)}}" v-on:click="TargetPoste('9', $event)">
                  <div class="player-info">
                    <label>{{$market->GetPostById(9)}}</label>
                  </div>
              </div>
            </div>
            <div class="player-line">
              <div class="players" style="background-image:{{$market->GetPostByIdImage(10)}}" v-on:click="TargetPoste('10', $event)">
                  <div class="player-info">
                    <label>{{$market->GetPostById(10)}}</label>
                  </div>
              </div>
              <div class="players" style="background-image:{{$market->GetPostByIdImage(11)}}" v-on:click="TargetPoste('11', $event)">
                  <div class="player-info">
                    <label>{{$market->GetPostById(11)}}</label>
                  </div>
              </div>
            </div>
            <div class="player-line">
              <div class="players" style="background-image:{{$market->GetPostByIdImage(12)}}" v-on:click="TargetPoste('12', $event)">
                  <div class="player-info">
                    <label>{{$market->GetPostById(12)}}</label>
                  </div>
              </div>
              <div class="players" style="background-image:{{$market->GetPostByIdImage(13)}}" v-on:click="TargetPoste('13', $event)">
                  <div class="player-info">
                    <label>{{$market->GetPostById(13)}}</label>
                  </div>
              </div>
              <div class="players" style="background-image:{{$market->GetPostByIdImage(14)}}" v-on:click="TargetPoste('14', $event)">
                  <div class="player-info">
                    <label>{{$market->GetPostById(14)}}</label>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col col-lg-4 card" id="player-market">
          <div class="form-group mt-4">
            <input type="text" class="form-control" placeholder="Nom du joueur" v-model="name" v-on:change="GetPlayerList">
            <select class="custom-select mt-3" v-model="club" v-on:change="GetPlayerList">
               <option>Agen</option>
               <option>Castres Olympique</option>
               <option>Stade Toulousain</option>
               <option>ASM Clermont</option>
               <option>Racing 92</option>
               <option>Stade Francais</option>
               <option>Club Toulonnais</option>
               <option>Lyon Olympique</option>
               <option>Section Paloise</option>
               <option>Grenoble Rugby</option>
               <option>Montpellier</option>
               <option>Stade Rochelais</option>
               <option>Bordeaux</option>
               <option>Perpigan</option>
            </select>
            <input type="range" class="mt-3" min="0" max="20" value="20" id="search_price" v-model="price">
            <center><label id="price_manager">Prix:@{{price}}</label></center>
            <h5>Poste recherché: <label class="text-primary" ref="poste">Tous</label></h5>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Nom</th>
                  <th scope="col">Prix</th>
                  <th scope="col">Club</th>
                </tr>
              </thead>
              <tbody id="table_loading">
                  <tr v-show="loading" v-for="(player, index) in players" style="display:none" class="player-selected" v-on:click="BuyPlayer(player)">
                    <td class="col" v-bind:class="{ have_player: player.have}">@{{ player.name }}</td>
                    <td v-bind:class="{ have_player: player.have}">@{{ player.price }}</td>
                    <td class="col" style="white-space: nowrap;" v-bind:class="{ have_player: player.have}">@{{ player.club }}</td>
                  </tr>
              </tbody>
            </table>
            <div class="nav-scroller py-1 mb-2">
              <nav class="nav d-flex justify-content-center">
                <ul class="pagination pagination-sm flex-sm-wrap" ref="pagination" v-show="loading" style="display:none">
                  <li class="page-item"><a class="page-link" href="#" v-on:click="PaginationAfter" ref="retour">Retour</a></li>


                  <li class="page-item"><a class="page-link" href="#" v-on:click="PaginationUp" v-if="page_up <= page_max">@{{page_up }}</a></li>
                  <li class="page-item"><a class="page-link" href="#" v-on:click="PaginationUp" v-if="page_up + 1 <= page_max">@{{page_up + 1}}</a></li>
                  <li class="page-item"><a class="page-link" href="#" v-on:click="PaginationUp" v-if="page_up  + 2<= page_max">@{{page_up + 2}}</a></li>
                  <li class="page-item"><a class="page-link" href="#" v-on:click="PaginationUp" v-if="page_up  + 3<= page_max">@{{page_up + 3}}</a></li>
                  <li class="page-item"><a class="page-link" href="#" v-on:click="PaginationUp" v-if="page_up  + 4<= page_max">@{{page_up + 4}}</a></li>

                  <li class="page-item"><a class="page-link" href="#" v-on:click="PaginationNext" ref="next">Suivant</a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="mobile-list">
      <center><h3>Mon Equipe</h3></center>
      <br /><br />
      <div class="container mt-1">

        <div class="counter"><ul class="countdown"></ul></div>
        <h5 id="money" style="float:left;color:#3fb3ff">Mon budget:{{$market->GetMoney()}}</h5><br /><br />
        <button type="button" class="btn btn-primary"  class="save_pl">Sauvegarder </button>
        <br /><br />
        <div class="rowmobile">
            <label>Arrière</label>
            <span>0/1</span>
        </div>
        <div class="list-group d-flex flex-column bd-highlight mb-3" id="mobile-groupe">
          <div class="list-group-item ">
            @if($market->GetPlayerById(0) == null)
              <label class="mobile-player target-m" v-on:click="TargetPosteMobile('0', $event)">Selectionner</label>
              <i class="fas fa-hand-pointer" ></i>
            @endif
            @if($market->GetPlayerById(0) != null)
              <img src={{$market->GetPostByIdImagemobile(0)}} height="50" width="50"/>
              <label class="mobile-info_player">{{$market->GetPlayerById(0)->name}}</label>
              <label class="mobile-info_player_club">{{$market->GetPlayerById(0)->club}}</label>
              <i class="fas fa-trash-alt delete-pl detele-mobile target-m" v-on:click="DeletePlayerMobile"></i>
            @endif
          </div>
        </div>
        <div class="rowmobile">
            <label>Ailier</label>
            <span>0/1</span>
        </div>
        <div class="list-group d-flex flex-column bd-highlight mb-3" id="mobile-groupe">

          <div class="list-group-item ">
            @if($market->GetPlayerById(1) == null)
              <label class="mobile-player target-m" v-on:click="TargetPosteMobile('1', $event)">Selectionner</label>
              <i class="fas fa-hand-pointer"></i>
            @endif
            @if($market->GetPlayerById(1) != null)
              <img src={{$market->GetPostByIdImagemobile(1)}} height="50" width="50"/>
              <label class="mobile-info_player">{{$market->GetPlayerById(1)->name}}</label>
              <label class="mobile-info_player_club">{{$market->GetPlayerById(1)->club}}</label>
              <i class="fas fa-trash-alt delete-pl detele-mobile target-m" v-on:click="DeletePlayerMobile"></i>
            @endif
          </div>
        </div>
        <div class="rowmobile">
            <label>Centre</label>
            <span>0/2</span>
        </div>
        <div class="list-group d-flex flex-column bd-highlight mb-3" id="mobile-groupe">
          <div class="list-group-item ">
            @if($market->GetPlayerById(2) == null)
              <label class="mobile-player target-m" v-on:click="TargetPosteMobile('2', $event)">Selectionner</label>
              <i class="fas fa-hand-pointer"></i>
            @endif
            @if($market->GetPlayerById(2) != null)
              <img src={{$market->GetPostByIdImagemobile(2)}} height="50" width="50"/>
              <label class="mobile-info_player">{{$market->GetPlayerById(2)->name}}</label>
              <label class="mobile-info_player_club">{{$market->GetPlayerById(2)->club}}</label>
              <i class="fas fa-trash-alt delete-pl detele-mobile target-m" v-on:click="DeletePlayerMobile"></i>
            @endif
          </div>
          <div class="list-group-item ">
            @if($market->GetPlayerById(3) == null)
              <label class="mobile-player target-m" v-on:click="TargetPosteMobile('3', $event)">Selectionner</label>
              <i class="fas fa-hand-pointer"></i>
            @endif
            @if($market->GetPlayerById(3) != null)
              <img src={{$market->GetPostByIdImagemobile(3)}} height="50" width="50"/>
              <label class="mobile-info_player">{{$market->GetPlayerById(3)->name}}</label>
              <label class="mobile-info_player_club">{{$market->GetPlayerById(3)->club}}</label>
              <i class="fas fa-trash-alt delete-pl detele-mobile target-m" v-on:click="DeletePlayerMobile"></i>
            @endif
          </div>
        </div>
        <div class="rowmobile">
            <label>Ailier</label>
            <span>0/1</span>
        </div>
        <div class="list-group d-flex flex-column bd-highlight mb-3" id="mobile-groupe">
          <div class="list-group-item ">
            @if($market->GetPlayerById(4) == null)
              <label class="mobile-player target-m" v-on:click="TargetPosteMobile('4', $event)">Selectionner</label>
              <i class="fas fa-hand-pointer"></i>
            @endif
            @if($market->GetPlayerById(4) != null)
              <img src={{$market->GetPostByIdImagemobile(4)}} height="50" width="50"/>
              <label class="mobile-info_player">{{$market->GetPlayerById(4)->name}}</label>
              <label class="mobile-info_player_club">{{$market->GetPlayerById(4)->club}}</label>
              <i class="fas fa-trash-alt delete-pl detele-mobile target-m" v-on:click="DeletePlayerMobile"></i>
            @endif
          </div>
        </div>
        <div class="rowmobile">
            <label>Ouverture</label>
            <span>0/1</span>
        </div>
        <div class="list-group d-flex flex-column bd-highlight mb-3" id="mobile-groupe">
          <div class="list-group-item ">
            @if($market->GetPlayerById(5) == null)
              <label class="mobile-player target-m" v-on:click="TargetPosteMobile('5', $event)">Selectionner</label>
              <i class="fas fa-hand-pointer"></i>
            @endif
            @if($market->GetPlayerById(5) != null)
              <img src={{$market->GetPostByIdImagemobile(5)}} height="50" width="50"/>
              <label class="mobile-info_player">{{$market->GetPlayerById(5)->name}}</label>
              <label class="mobile-info_player_club">{{$market->GetPlayerById(5)->club}}</label>
              <i class="fas fa-trash-alt delete-pl detele-mobile target-m" v-on:click="DeletePlayerMobile"></i>
            @endif
          </div>
        </div>
        <div class="rowmobile">
            <label>Melée</label>
            <span>0/1</span>
        </div>
        <div class="list-group d-flex flex-column bd-highlight mb-3" id="mobile-groupe">
          <div class="list-group-item ">
            @if($market->GetPlayerById(6) == null)
              <label class="mobile-player target-m" v-on:click="TargetPosteMobile('6', $event)">Selectionner</label>
              <i class="fas fa-hand-pointer"></i>
            @endif
            @if($market->GetPlayerById(6) != null)
              <img src={{$market->GetPostByIdImagemobile(6)}} height="50" width="50"/>
              <label class="mobile-info_player">{{$market->GetPlayerById(6)->name}}</label>
              <label class="mobile-info_player_club">{{$market->GetPlayerById(6)->club}}</label>
              <i class="fas fa-trash-alt delete-pl detele-mobile target-m" v-on:click="DeletePlayerMobile"></i>
            @endif
          </div>
        </div>
        <div class="rowmobile">
            <label>3emeligne</label>
            <span>0/3</span>
        </div>
        <div class="list-group d-flex flex-column bd-highlight mb-3" id="mobile-groupe">
          <div class="list-group-item ">
            @if($market->GetPlayerById(7) == null)
              <label class="mobile-player target-m" v-on:click="TargetPosteMobile('7', $event)">Selectionner</label>
              <i class="fas fa-hand-pointer"></i>
            @endif
            @if($market->GetPlayerById(7) != null)
              <img src={{$market->GetPostByIdImagemobile(7)}} height="50" width="50"/>
              <label class="mobile-info_player">{{$market->GetPlayerById(7)->name}}</label>
              <label class="mobile-info_player_club">{{$market->GetPlayerById(7)->club}}</label>
              <i class="fas fa-trash-alt delete-pl detele-mobile target-m" v-on:click="DeletePlayerMobile"></i>
            @endif
          </div>
          <div class="list-group-item ">
            @if($market->GetPlayerById(8) == null)
              <label class="mobile-player target-m" v-on:click="TargetPosteMobile('8', $event)">Selectionner</label>
              <i class="fas fa-hand-pointer"></i>
            @endif
            @if($market->GetPlayerById(8) != null)
              <img src={{$market->GetPostByIdImagemobile(8)}} height="50" width="50"/>
              <label class="mobile-info_player">{{$market->GetPlayerById(8)->name}}</label>
              <label class="mobile-info_player_club">{{$market->GetPlayerById(8)->club}}</label>
              <i class="fas fa-trash-alt delete-pl detele-mobile target-m" v-on:click="DeletePlayerMobile"></i>
            @endif
          </div>
          <div class="list-group-item ">
            @if($market->GetPlayerById(9) == null)
              <label class="mobile-player target-m" v-on:click="TargetPosteMobile('9', $event)">Selectionner</label>
              <i class="fas fa-hand-pointer"></i>
            @endif
            @if($market->GetPlayerById(9) != null)
              <img src={{$market->GetPostByIdImagemobile(9)}} height="50" width="50"/>
              <label class="mobile-info_player">{{$market->GetPlayerById(9)->name}}</label>
              <label class="mobile-info_player_club">{{$market->GetPlayerById(9)->club}}</label>
              <i class="fas fa-trash-alt delete-pl detele-mobile target-m" v-on:click="DeletePlayerMobile"></i>
            @endif
          </div>
        </div>
        <div class="rowmobile">
            <label>2emeligne</label>
            <span>0/2</span>
        </div>
        <div class="list-group d-flex flex-column bd-highlight mb-3" id="mobile-groupe">
          <div class="list-group-item ">
            @if($market->GetPlayerById(10) == null)
              <label class="mobile-player target-m" v-on:click="TargetPosteMobile('10', $event)">Selectionner</label>
              <i class="fas fa-hand-pointer"></i>
            @endif
            @if($market->GetPlayerById(10) != null)
              <img src={{$market->GetPostByIdImagemobile(10)}} height="50" width="50"/>
              <label class="mobile-info_player">{{$market->GetPlayerById(10)->name}}</label>
              <label class="mobile-info_player_club">{{$market->GetPlayerById(10)->club}}</label>
              <i class="fas fa-trash-alt delete-pl detele-mobile target-m" v-on:click="DeletePlayerMobile"></i>
            @endif
          </div>
          <div class="list-group-item ">
            @if($market->GetPlayerById(11) == null)
              <label class="mobile-player target-m" v-on:click="TargetPosteMobile('11', $event)">Selectionner</label>
              <i class="fas fa-hand-pointer"></i>
            @endif
            @if($market->GetPlayerById(11) != null)
              <img src={{$market->GetPostByIdImagemobile(11)}} height="50" width="50"/>
              <label class="mobile-info_player">{{$market->GetPlayerById(11)->name}}</label>
              <label class="mobile-info_player_club">{{$market->GetPlayerById(11)->club}}</label>
              <i class="fas fa-trash-alt delete-pl detele-mobile target-m" v-on:click="DeletePlayerMobile"></i>
            @endif
          </div>
        </div>
        <div class="rowmobile">
            <label>Pilier</label>
            <span>0/1</span>
        </div>
        <div class="list-group d-flex flex-column bd-highlight mb-3" id="mobile-groupe">
          <div class="list-group-item ">
            @if($market->GetPlayerById(12) == null)
              <label class="mobile-player target-m" v-on:click="TargetPosteMobile('12', $event)">Selectionner</label>
              <i class="fas fa-hand-pointer"></i>
            @endif
            @if($market->GetPlayerById(12) != null)
              <img src={{$market->GetPostByIdImagemobile(12)}} height="50" width="50"/>
              <label class="mobile-info_player">{{$market->GetPlayerById(12)->name}}</label>
              <label class="mobile-info_player_club">{{$market->GetPlayerById(12)->club}}</label>
              <i class="fas fa-trash-alt delete-pl detele-mobile target-m" v-on:click="DeletePlayerMobile"></i>
            @endif
          </div>
        </div>
        <div class="rowmobile">
            <label>Talonneur</label>
            <span>0/1</span>
        </div>
        <div class="list-group d-flex flex-column bd-highlight mb-3" id="mobile-groupe">
          <div class="list-group-item ">
            @if($market->GetPlayerById(13) == null)
              <label class="mobile-player target-m" v-on:click="TargetPosteMobile('13', $event)">Selectionner</label>
              <i class="fas fa-hand-pointer"></i>
            @endif
            @if($market->GetPlayerById(13) != null)
              <img src={{$market->GetPostByIdImagemobile(13)}} height="50" width="50"/>
              <label class="mobile-info_player">{{$market->GetPlayerById(13)->name}}</label>
              <label class="mobile-info_player_club">{{$market->GetPlayerById(13)->club}}</label>
              <i class="fas fa-trash-alt delete-pl detele-mobile target-m" v-on:click="DeletePlayerMobile"></i>
            @endif
          </div>
        </div>
        <div class="rowmobile">
            <label>Pilier</label>
            <span>0/1</span>
        </div>
        <div class="list-group d-flex flex-column bd-highlight mb-3" id="mobile-groupe">
          <div class="list-group-item ">
            @if($market->GetPlayerById(14) == null)
            <label class="mobile-player target-m" v-on:click="TargetPosteMobile('14', $event)">Selectionner</label>
              <i class="fas fa-hand-pointer"></i>
            @endif
            @if($market->GetPlayerById(14) != null)
              <img src={{$market->GetPostByIdImagemobile(14)}} height="50" width="50"/>
              <label class="mobile-info_player">{{$market->GetPlayerById(14)->name}}</label>
              <label class="mobile-info_player_club">{{$market->GetPlayerById(14)->club}}</label>
              <i class="fas fa-trash-alt delete-pl detele-mobile target-m" v-on:click="DeletePlayerMobile"></i>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('/js/app_market.js') }}"></script>
  </body>
</html>

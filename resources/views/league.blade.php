@include('navbar')
@inject('league', "App\Utility\SimplifyLeague")
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Laravel</title>
      <link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
    </head>
    <body>
      <div id="app" class="container-fluid" style="font-family: 'Asap', sans-serif;">
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
                <div class="modal-footer" ref="league_footer">
                  <button type="button" class="btn btn-secondary close-p" data-dismiss="modal" v-on:click="CloseModal">Fermer</button>
                </div>
              </div>
            </div>
          </div>
          <div  class="row mt-4">
              @if($league->GetLeague() != "")
                <button class="col button_league" @click="ShowBlockLeague">Ma League</button>
              @endif

              <button class="col ml-2 button_league" @click="ShowJoinLeague">Rejoindre League</button>
              <button class="col ml-2 button_league" @click="ShowCreateLeague">Créer une league</button>
          </div>
          <div style="width:100%;display:none" class="card mt-2" v-show="ShowJoin">
            <div class="col-sm-12 mt-2">
                <input class="form-control mr-sm-2" type="search" placeholder="Code De la league" aria-label="Search" v-model="token_league">
            </div>
            <div class="col-sm-12 mt-2">
                <center><button type="button" class="btn btn-outline-primary mx-auto"  @click="JoinLeague">Rejoindre</button></center>
            </div>
            <div style="height:10px;">

            </div>
          </div>
          <div style="width:100%;display:none" class="card mt-2" v-show="ShowCreate">
            <div class="col-sm-12">
                <input class="form-control mr-sm-2 mt-2" type="search" placeholder="Nom De la league" v-model="create_name">
                <label class="mt-2">Nombre de joueurs:</label>
                <select class="form-control" id="exampleFormControlSelect1" v-model="create_max">
                  <option>2</option>
                  <option>4</option>
                  <option>6</option>
                  <option>8</option>
                  <option>10</option>
                  <option>12</option>
                </select>
                <br />
                <h6>Votre bannière:</h6>
                <div class="row ">
                  <div class="card ml-3 banier-el" @click="SelectBaniere('baniere_test', $event)" style="background:#ff4a4a">
                      <img src="/images/baniere_test.png" height="80" width="80" />
                  </div>
                  <div class="card ml-2 banier-el" @click="SelectBaniere('baniere_test', $event)" style="background:#009688">
                      <img src="/images/baniere_test.png" height="80" width="80"/>
                  </div>
                  <div class="card ml-2 banier-el" @click="SelectBaniere('baniere_test', $event)" style="background:#9C27B0;" >
                      <img src="/images/baniere_test.png" height="80" width="80"/>
                  </div>
                </div>
                <br />
                <div class="row">
                  <div class="card ml-3 banier-el"  @click="SelectBaniere('baniere_ball', $event)" style="background:#4aff54">
                      <img src="/images/baniere_ball.png" height="80" width="80" />
                  </div>
                  <div class="card ml-2 banier-el" @click="SelectBaniere('baniere_ball', $event)" style="background:#3f51b5">
                      <img src="/images/baniere_ball.png" height="80" width="80"/>
                  </div>
                  <div class="card ml-2 banier-el" @click="SelectBaniere('baniere_ball', $event)" style="background:#ffd13b;" >
                      <img src="/images/baniere_ball.png" height="80" width="80"/>
                  </div>
                </div>
            </div>
            <div class="col-sm-12 mt-2">
                <center><button type="button" class="btn btn-outline-primary mx-auto" @click="CreateLeague">Créer League</button></center>
            </div>
            <div style="height:10px;">

            </div>
          </div>
          <div style="width:100%;display:none" class="card mt-2" v-show="ShowLeague">
            <div class="col-12 mt-2">
                <h5>Informations:</h5>
                <ul>
                  <li>Nom league: {{ $league->GetLeague()}}</li>
                  <li>Nombre de participants: {{ $league->GetPlayers()}}</li>
                </ul>
                <h5 class="text-primary">Mes infos:</h5>
                <ul>
                  <li>Mon pseudo: {{ $league->MesInfos()->name}}</li>
                  <li>Mes points: {{ $league->MesInfos()->points}}</li>
                </ul>
                @if($league->GetLeagueOwner() == false)
                  <button type="button" class="btn btn-danger" @click="QuitLeague()">Quittez la league</button>
                @endif
                @if($league->GetLeagueOwner() == true)
                  <button type="button" class="btn btn-danger" @click="QuitLeagueOwner()">Supprimer ma league</button>
                @endif
                @if($league->GetLeagueOwner() == true)
                  <div class="row">
                    <div class="col-sm-7 mt-1">

                      <input class="form-control" type="text" placeholder="Email de vos amis" aria-label="Search" v-model="send_email">
                    </div>
                    <div class="col">
                      <button type="button" class="btn btn-primary mt-1" @click="SendCodeLeague">Envoyer Code</button>
                    </div>
                  </div>
                @endif
                <div style="height:10px;">

                </div>
            </div>

            <div class="col-12 " style="background:#343a40;height:40px;">
                <h5 style="color:white;line-height:40px;">Classement Amis:</h5>
            </div>
            <div class="col-12 mt-2">
              <?php $index = 1?>
              @foreach ($league->GetListFriends() as $user)
                @if(html_entity_decode($user->name, ENT_QUOTES, 'UTF-8') == $league->MesInfos()->name)
                  <div class="league-pl mt-1" >
                      <img src="/storage/profiles/{{ $user->avatar }}" height="95" width="95"/>
                      <label><h4 style="color:#ff5722">{!! html_entity_decode($user->name, ENT_QUOTES, 'UTF-8') !!} </h4></label>
                      <label><span>Points:{{$user->points}} </span></label>
                      <label><h6>Rang:{{$index}} </h6></label>
                  </div>
                @endif
                @if(html_entity_decode($user->name, ENT_QUOTES, 'UTF-8') != $league->MesInfos()->name)
                  @if($user->avatar == "")
                    <div class="league-pl mt-1">
                        <img src="/images/avatar.png" height="95" width="95"/>
                        <label><h4>{!! html_entity_decode($user->name, ENT_QUOTES, 'UTF-8') !!} </h4></label>
                        <label><span>Points:{{$user->points}} </span></label>
                        <label><h6>Rang:{{$index}} </h6></label>
                    </div>
                  @endif
                  @if($user->avatar != "")
                    <div class="league-pl mt-1">
                        <img src="/storage/profiles/{{ $user->avatar }}" height="95" width="95"/>
                        <label><h4>{!! html_entity_decode($user->name, ENT_QUOTES, 'UTF-8') !!} </h4></label>
                        <label><span>Points:{{$user->points}} </span></label>
                        <label><h6>Rang:{{$index}} </h6></label>
                    </div>
                  @endif
                @endif
                <?php $index++?>
              @endforeach
            </div>
            <div style="height:10px;">

            </div>
          </div>

        </div>
    <script src="/js/app_league.js"></script>
    </body>
</html>

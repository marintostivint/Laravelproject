@inject('dash', "App\Utility\SimplifyAdmin")
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
      Date Limite
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="{{ asset('/css/Admin/material-dashboard.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/Admin/datedropper.css') }}" rel="stylesheet">




  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <div class="logo">
        <a class="simple-text logo-normal">
            Date Limite
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="/dashboard">
              <i class="material-icons notranslate">dashboard</i>
              <p>Tableau de bord</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/dashboard_table">
              <i class="material-icons notranslate">content_paste</i>
              <p>Tableaux League</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="/dashboard_users">
              <i class="material-icons notranslate">content_paste</i>
              <p>Tableaux Utilisateurs</p>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="/dashboard_limite">
              <i class="material-icons notranslate">date_range</i>
              <p>Date Limite</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/dashboard_equipe">
              <i class="material-icons notranslate">date_range</i>
              <p>Taches</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="/dashboard_news">
              <i class="material-icons notranslate">event</i>
              <p>Nouvelle</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="/dashboard_pub">
              <i class="material-icons notranslate">public</i>
              <p>Publicités</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="/dashboard_mail">
              <i class="material-icons notranslate">markunread_mailbox</i>
              <p>Mail</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="app">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="#pablo">Date Limite</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
            <div class="col">
              <div class="form-row" id="actions-bar" v-show="!choice_state">
                <div class="col-lg-3">
                  <input  type="text" id="datepicker" ref="date" class="form-control" placeholder="Date limite" data-modal="true" data-lang="fr" data-large-default="true" data-large-mode="true"/>
                </div>
                <div class="col-sm-2">
                  <select class="custom-select" v-model="heures">
                     <option disabled selected>Heures</option>
                     <option>1</option>
                     <option>2</option>
                     <option>3</option>
                     <option>4</option>
                     <option>5</option>
                     <option>6</option>
                     <option>7</option>
                     <option>8</option>
                     <option>9</option>
                     <option>10</option>
                     <option>11</option>
                     <option>12</option>
                     <option>13</option>
                     <option>14</option>
                     <option>15</option>
                     <option>16</option>
                     <option>17</option>
                     <option>18</option>
                     <option>19</option>
                     <option>20</option>
                     <option>21</option>
                     <option>22</option>
                     <option>23</option>
                     <option>24</option>
                   </select>
                </div>
                <div class="col-sm-2">
                  <select class="custom-select" v-model="minutes">
                     <option disabled selected>Minutes</option>
                     <option>5</option>
                     <option>10</option>
                     <option>15</option>
                     <option>20</option>
                     <option>25</option>
                     <option>30</option>
                     <option>35</option>
                     <option>40</option>
                     <option>45</option>
                     <option>50</option>
                     <option>55</option>
                   </select>
                </div>
                <div class="col-md-5">
                  <button type="button" class="btn btn-primary" style="margin-top:-0.5px" v-on:click="UpdateDate()">Mettre a jour date</button>
                  <button type="button" class="btn btn-danger" style="margin-top:-0.5px" v-on:click="GlobalCalcul()">Calcul Global</button>
                </div>
              </div>
              <div class="col">
                <player-table v-show="choice_state" style="display:none"></player-table>
              </div>

              <div class="card" id="tableau-calcul" v-show="!choice_state">
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <div class="form-row">
                      <h3>Equipe:</span></h3>
                      <select class="custom-select" v-model="target_club" v-on:change="ClubChange">
                        <option selected>Agen</option>
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
                      <div class="col mt-1">
                          <label>Score:</label>
                          <input type="text" placeholder="0"  class="score" ref="score1"/>
                          <label>Vs</label>
                          <input type="text"  placeholder="0" class="score" ref="score2"/>
                          <label><h5> à Domicile</h5></label>
                          <input  type="checkbox"  v-model="scored">
                          <button type="button" class="btn btn-primary"  v-on:click="UpdateScore()">Soumettre</button>
                      </div>
                    </div>
                    <div class="form-row mt-1">
                      <div class="col-sm-2" style="margin-left:-5px;">
                        <button type="button"   class="btn btn-warning" style="margin-top:-0.5px" v-on:click="CalculEquipe()">Sauvgarde et calcule pour cette équipe</button>
                      </div>
                    </div>
                    <thead class="text-warning">
                      <th>Joueur</th>
                      <th>Equipe</th>
                      <th>Poste</th>
                      <th>Nb de min</th>
                      <th>Pts équipe</th>
                      <th>Essais</th>
                      <th>Penalités</th>
                      <th>Drops</th>
                      <th>Carton jaune</th>
                      <th>Carton rouge</th>
                      <th>Pts match</th>
                    </thead>
                    <tbody>
                        <tr is="player-row" v-for="n in 15">

                        </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="modal-vue " tabindex="-1" role="dialog" v-show="modalShow" style="display:none !important">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" ref="title">Modal title</h5>
                      <button type="button" class="close"  data-dismiss="modal" aria-label="Close" v-on:click="CloseModal">
                        <span aria-hidden="true" >&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p ref="message">Modal body text goes here.</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="CloseModal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('/js/Admin/jquery.min.js') }}"></script>
  <script src="{{ asset('/js/app.js') }}"></script>
  <script src="{{ asset('/js/Admin/popper.min.js') }}"></script>
  <script src="{{ asset('/js/Admin/bootstrap-material-design.min.js') }}"></script>
  <script src="{{ asset('/js/Admin/perfect-scrollbar.jquery.min.js') }}"></script>
  <script src="{{ asset('/js/Admin/chartist.min.js') }}"></script>
  <script src="{{ asset('/js/Admin/bootstrap-notify.js') }}"></script>
  <script src="{{ asset('/js/Admin/material-dashboard.min.js') }}"></script>
  <script src="{{ asset('/js/Admin/datedropper.js') }}"></script>
  <script>
    $('#datepicker').dateDropper();
  </script>
</body>
</html>

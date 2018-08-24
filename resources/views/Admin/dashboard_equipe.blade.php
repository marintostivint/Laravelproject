@inject('dash', "App\Utility\SimplifyAdmin")
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
      Taches
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
            Taches
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item ">
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
          <li class="nav-item">
            <a class="nav-link" href="/dashboard_limite">
              <i class="material-icons notranslate">date_range</i>
              <p>Date Limite</p>
            </a>
          </li>
          <li class="nav-item active">
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
            <a class="navbar-brand" href="#pablo">Taches</a>
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
              <div class="card">
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <div class="form-row">
                      <select class="custom-select" v-model="club">
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
                    </div>
                    <br />
                    <div class="form-row">
                      <input type="text" placeholder="Nom du joueur"  class="custom-select" v-model="name"/>
                    </div>
                    <br />
                    <div class="form-row">
                      <select class="custom-select" v-model="poste">
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
                    <br />
                    <div class="form-row">
                      <input type="text" placeholder="Prix du joueur"  class="custom-select" v-model="price"/>
                    </div>
                    <br />
                    <div class="form-row">
                      <button class="btn btn-primary" v-on:click="AddPlayer">Ajouter un joueur</button>
                    </div>
                  </table>
                </div>
              </div>
              <div class="modal-vue " tabindex="-1" role="dialog"  style="display:none !important">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" ref="title">Modal title</h5>
                      <button type="button" class="close"  data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true" >&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p ref="message">Modal body text goes here.</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal" >Close</button>
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
  <script src="{{ asset('/js/app_equipe.js') }}"></script>
  <script src="{{ asset('/js/Admin/popper.min.js') }}"></script>
  <script src="{{ asset('/js/Admin/bootstrap-material-design.min.js') }}"></script>
  <script src="{{ asset('/js/Admin/perfect-scrollbar.jquery.min.js') }}"></script>
  <script src="{{ asset('/js/Admin/chartist.min.js') }}"></script>
  <script src="{{ asset('/js/Admin/bootstrap-notify.js') }}"></script>
  <script src="{{ asset('/js/Admin/material-dashboard.min.js') }}"></script>
  <script src="{{ asset('/js/Admin/datedropper.js') }}"></script>
</body>
</html>

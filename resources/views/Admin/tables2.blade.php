@inject('dash', "App\Utility\SimplifyAdmin")
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
      Tableaux Utilisateurs
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="{{ asset('/css/Admin/material-dashboard.min.css') }}" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <div class="logo">
        <a class="simple-text logo-normal">
          Tableaux Utilisateurs
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
          <li class="nav-item active">
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
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="#pablo">Tableaux Utilisateurs</a>
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
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title">Touts les utilisateurs</h4>
                  <p class="card-category">Liste complète des utilisateurs</p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>ID</th>
                      <th>Pseudo</th>
                      <th>League</th>
                      <th>Email</th>
                      <th class="float-right">Actions</th>
                    </thead>
                    <tbody>
                      @foreach ($dash->GetAllUsers() as $user)
                      <tr>
                        <td id="league_id">{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{!!$user->league!!}</td>
                        <td>{{$user->email}}</td>
                        <td class="float-right">
                          <form method="post" action="AdminDeleteUser" >
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                            <input  name="id" type="hidden" value={{$user->id}}>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $dash->GetAllUsers()->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('/js/Admin/jquery.min.js') }}"></script>
  <script src="{{ asset('/js/Admin/popper.min.js') }}"></script>
  <script src="{{ asset('/js/Admin/bootstrap-material-design.min.js') }}"></script>
  <script src="{{ asset('/js/Admin/perfect-scrollbar.jquery.min.js') }}"></script>
  <script src="{{ asset('/js/Admin/chartist.min.js') }}"></script>
  <script src="{{ asset('/js/Admin/bootstrap-notify.js') }}"></script>
  <script src="{{ asset('/js/Admin/material-dashboard.min.js') }}"></script>
  <script src="{{ asset('/js/Admin/gestion.js') }}"></script>
</body>
</html>

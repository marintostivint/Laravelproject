@inject('dash', "App\Utility\SimplifyAdmin")
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
      Dashboard
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
          Tableau de bord
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active">
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
          <li class="nav-item ">
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
            <a class="navbar-brand" href="#pablo">Dashboard</a>
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
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">contacts</i>
                  </div>
                  <p class="card-category">Nombre Utilisateurs</p>
                  <h3 class="card-title">10000
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">date_range</i> Nombre total
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">group</i>
                  </div>
                  <p class="card-category">Nombre League</p>
                  <h3 class="card-title">1500</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">date_range</i> Nombre total
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">public</i>
                  </div>
                  <p class="card-category">Publicités</p>
                  <h3 class="card-title">75</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">local_offer</i> Recherche globale
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">attach_money</i>
                  </div>
                  <p class="card-category">Revenue</p>
                  <h3 class="card-title">50000$</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">update</i>Revenue globale
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">

          </div>
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-tabs card-header-primary">
                  <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                      <span class="nav-tabs-title">Tâches:</span>
                      <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                          <a class="nav-link active" href="#profile" data-toggle="tab">
                            <i class="material-icons">bug_report</i> Toutes
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                      <table class="table" id="all-tasks">
                        <tbody>
                          @foreach ($dash->GetAllTask() as $task)
                          <tr>
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input checkbox-tasks" type="checkbox" value="" {{$task->finish}}>
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
                            <td>{{$task->title}}</td>
                            <td class="td-actions text-right">
                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons delete_tasks">close</i>
                              </button>
                            </td>
                            <td>
                                <label class="tasks_id">{{$task->id}}</label>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane" id="messages">

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title">Derniers resultat membres</h4>
                  <p class="card-category">les 10 meilleurs résulats</p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>ID</th>
                      <th>Points</th>

                    </thead>
                    <tbody>
                      @foreach ($dash->GetLastUsers() as $user)
                      <tr>
                        <td>{{$user->email}}</td>
                        <td>{{$user->points}}pts</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
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

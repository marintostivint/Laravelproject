<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Demie D'ouverture</title>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
      <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
      <link href="css/business-frontpage.css" rel="stylesheet">
      <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Montserrat:500" rel="stylesheet">
      <title>Laravel</title>
    </head>
    <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="/"><img src="/images/france.png" width="30" height="30"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="/equipe">Equipe</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="league">League</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Classement</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Récompenses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/forum/category/tout">Forum</a>
        </li>
      </ul>
      @auth
      <form class="form-inline my-2 my-lg-0">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="/dashboard" style="color:#ffc300">Administration</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mr-2 text-success" href="/gifs">Rugby Gifs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mr-2" href="/profil">Mon Profil</a>
          </li>
          <li class="nav-item">
              <a href="/logout"><i class="fas fa-sign-out-alt fa-2x" style="color:#d1d1d1;line-height:40px;"></i></a>
          </li>
        </ul>
      </form>
      @else
      <form class="form-inline my-2 my-lg-0">
        <a href="/connexion"><button class="btn btn-outline-primary my-2 my-sm-0 mr-2" type="button">Se connecter</button></a>
        <a href="/inscription"><button class="btn btn-outline-success my-2 my-sm-0" type="button">S'inscrire</button></a>
      </form>
      @endauth
    </div>
    </nav>
    </body>
</html>

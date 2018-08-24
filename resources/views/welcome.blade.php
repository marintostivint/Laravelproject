@include('navbar')
@inject('home', "App\Utility\SimplifyHome")
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Laravel</title>
      <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    </head>
    <body>
      <!-- Header with Background Image -->
      <img src="/images/baniere.jpg" class="baniere"/>


      <!-- Page Content -->
      <div class="container">
        @if ($message = Session::get('auth_success'))
          <div class="modal-vue" tabindex="-1" role="dialog" >
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Information</h5>
                  <button type="button" class="close close-p" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p style="color:green">{{$message}}</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary close-p " data-dismiss="modal">Fermer</button>
                </div>
              </div>
            </div>
          </div>
        @endif
        @if ($message = Session::get('auth_error'))
          <div class="modal-vue" tabindex="-1" role="dialog" >
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Information</h5>
                  <button type="button" class="close close-p" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p style="color:red">{{$message}}</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary close-p" data-dismiss="modal">Fermer</button>
                </div>
              </div>
            </div>
          </div>
        @endif
        <div class="row">
          <div class="col-sm-8">
            <h2 class="mt-4">À propos de nous</h2>
            <p>Notre site Demie d'ouverture vous propose une éxperience de jeu entre amis exceptionnel.Sur ce site vous pourrez par exemple créer une equipe de 20 joueurs.
              Dans cette équipe vous aurez la possibilité de faire des changements à chaque nouvelle deadline.
              Vous pourrez aussi rejoindre une league avec vos amis en vous envoyant un code.
              Le classement des joueurs sera déterminé à la fin de la saison.<br />
              Merci est bonne éxperience de jeu <i class="far fa-thumbs-up"></i>.
            </p>
            <p>
              <a class="btn btn-primary btn-lg" href="#">Tutoriel &raquo;</a>
            </p>
          </div>
          <div class="col-sm-4">
            <h2 class="mt-4">Les Règles</h2>
            <address>
              <strong>règles du jeu et reglements</strong>
              <br />
              <button type="button" class="btn btn-outline-warning mt-2">Reglements</button>
              <button type="button" class="btn btn-outline-primary mt-2">Charte</button>
            </address>
            <h5 class="">Contact</h5>
              <button type="button" class="btn mt-2 social-fac"><i class="fab fa-facebook-square fa-1x"></i> Notre page facebook</button>
              <button type="button" class="btn mt-2 social-twi"><i class="fab fa-twitter-square fa-1x"></i> Notre page twitter !!! </button>
            </address>
          </div>
        </div>

        <h4 class="mt-4">Nouveaux articles:</h4>
        <div class="row" id="articles">
          @foreach ($home->GetArticleList() as $article)
            <div class="col-sm-4 my-4">
              <div class="card article">
                <img class="card-img-top" src="{{$article->image}}" alt="">
                @if($article->new == true)
                    <div class="news-alert">
                        <i class="fas fa-bell"></i>
                    </div>
                @endif
                <div class="card-body">
                  <h4 class="card-title">{{$article->name}}</h4>
                  <p class="card-text">{{$article->info}}</p>
                  <h6 class="article-date" v-model="date">{{$home->GetArticleDateId($article->id)}}</h6>
                </div>
                <div class="card-footer">
                  <a href="{{$article->link}}" class="btn btn-primary">Voir l'article</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <footer class="py-5 bg-dark">
        <div class="container">
          <p class="m-0 text-center text-white">Copyright &copy; Demie D'ouverture 2018</p>
        </div>
      </footer>
    <script>
      $('.close-p').click(function() {
        $('.modal-vue').hide();
      });
    </script>
    </body>
</html>

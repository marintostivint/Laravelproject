@include('navbar')
@inject('rewards', "App\Utility\SimplifyReward")
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
      <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
      <title>Laravel</title>
    </head>
    <body>
      <div class="content mt-4">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 mt-2 " class="gifs-day">
              <div class="card " style="border-bottom: 6px solid red;">
                <div class="card-header-warning card-header-icon">
                  <div class="card-icon">
                    <center><h5 class="mt-2">Jour 1 recompense n°1</h5></center>
                    @if($rewards->GetRewards("0 day") === true)
                      <form method="post" action="GetReward">
                        {{ csrf_field() }}
                        <center><button type="submit" class="btn btn-primary gifs-day-active"><i class="fas fa-lock-open"></i> Ouvrir Récompense</button></center>
                        <center><i class="fas fa-check-circle mt-2 " style="color:#4fc04f;font-size:40px;"></i></center>
                        <input name="day" type="hidden" value="0 day">
                      </form>
                    @endif
                    @if($rewards->GetRewards("0 day") === false)
                      <center><button type="button" class="btn btn-primary"><i class="fas fa-lock"></i> Ouvrir Récompense</button></center>
                      <center><i class="fas fa-times mt-2 " style="color:#ff6262;font-size:40px;"></i></center>
                    @endif
                    <br />
                  </div>
                  </h3>
                </div>

              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-2 ">
              <div class="card " style="border-bottom: 6px solid #0061ff;">
                <div class="card-header-warning card-header-icon">
                  <div class="card-icon">
                    <center><h5 class="mt-2">Jour 25 recompense n°2</h5></center>
                    @if($rewards->GetRewards("25 day") === true)
                      <form method="post" action="GetReward">
                        {{ csrf_field() }}
                        <center><button type="submit" class="btn btn-primary gifs-day-active"><i class="fas fa-lock-open"></i> Ouvrir Récompense</button></center>
                        <center><i class="fas fa-check-circle mt-2 " style="color:#4fc04f;font-size:40px;"></i></center>
                        <input name="day" type="hidden" value="25 day">
                      </form>
                    @endif
                    @if($rewards->GetRewards("25 day") === false)
                      <center><button type="button" class="btn btn-primary"><i class="fas fa-lock"></i> Ouvrir Récompense</button></center>
                      <center><i class="fas fa-times mt-2 " style="color:#ff6262;font-size:40px;"></i></center>
                    @endif
                    <br />
                  </div>
                  </h3>
                </div>

              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-2 ">
              <div class="card " style="border-bottom: 6px solid #3bbb3b;">
                <div class="card-header-warning card-header-icon">
                  <div class="card-icon">
                    <center><h5 class="mt-2">Jour 40 recompense n°3</h5></center>
                    @if($rewards->GetRewards("40 day") === true)
                      <form method="post" action="GetReward">
                        {{ csrf_field() }}
                        <center><button type="submit" class="btn btn-primary gifs-day-active"><i class="fas fa-lock-open"></i> Ouvrir Récompense</button></center>
                        <center><i class="fas fa-check-circle mt-2 " style="color:#4fc04f;font-size:40px;"></i></center>
                        <input name="day" type="hidden" value="40 day">
                      </form>
                    @endif
                    @if($rewards->GetRewards("40 day") === false)
                      <center><button type="button" class="btn btn-primary"><i class="fas fa-lock"></i> Ouvrir Récompense</button></center>
                      <center><i class="fas fa-times mt-2 " style="color:#ff6262;font-size:40px;"></i></center>
                    @endif
                    <br />
                  </div>
                  </h3>
                </div>

              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-2 ">
              <div class="card " style="border-bottom: 6px solid #ffaa00;">
                <div class="card-header-warning card-header-icon">
                  <div class="card-icon">
                    <center><h5 class="mt-2">Jour 75 recompense n°4</h5></center>
                    {{$rewards->GetRewards("75 day")}}
                    @if($rewards->GetRewards("75 day") === true)
                      <form method="post" action="GetReward">
                        {{ csrf_field() }}
                        <center><button type="submit" class="btn btn-primary gifs-day-active"><i class="fas fa-lock-open"></i> Ouvrir Récompense</button></center>
                        <center><i class="fas fa-check-circle mt-2 " style="color:#4fc04f;font-size:40px;"></i></center>
                        <input name="day" type="hidden" value="75 day">
                      </form>
                    @endif
                    @if($rewards->GetRewards("75 day") === false)
                      <center><button type="button" class="btn btn-primary"><i class="fas fa-lock"></i> Ouvrir Récompense</button></center>
                      <center><i class="fas fa-times mt-2 " style="color:#ff6262;font-size:40px;"></i></center>
                    @endif
                    <br />
                  </div>
                  </h3>
                </div>

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col  mt-2 ">
              <div class="col card">
                  <h3 class="mt-2">Informations:</h3>
                  <h5 class="ml-3 text-success">Liste récompenses:</h5>
                  <ul>
                    <li><h6>10 rugby's coins</h6></li>
                    <li><h6>100 points exp</h6></li>
                    <li><h6>1 joueur aléatoire offert (prix entre 5 ou 7 rugby's coins)</h6></li>
                  </ul>

                  <h5 class="ml-3 text-primary">Liste dernier gagnants:</h5>
                  <ul>
                    @foreach ($rewards->GetLastWinners() as $user)
                      <li><h6>{{$user}}</h6></li>
                    @endforeach
                  </ul>
                  <i class="fas fa-exclamation-triangle text-danger"><label><h5> Cette récompense n'est valable qu'une seule fois.</h5></label></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </body>
</html>

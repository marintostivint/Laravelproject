@include('navbar')
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Laravel</title>
      <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    </head>
    <body class="background-img">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="signup-form col col-lg-5">
            <form action="/register/basic" method="post">
             @csrf
        		<h2>Inscription</h2>
        		<p>Remplir tous les champs sil vous plaît!</p>
        		<hr>
                <div class="form-group">
                  <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Pseudo">
                  </div>
                </div>
                  <div class="form-group">
                	   <input type="email" class="form-control" name="email" placeholder="Email" >
                  </div>
        		      <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Mot de passe" >
                  </div>
        		      <div class="form-group">
                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirmer mot de passe">
                  </div>
                <div class="form-group">
        			<label class="checkbox-inline"><input type="checkbox" > I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
        		</div>
        		<div class="form-group">
                    <center><button type="submit" class="btn btn-primary btn-lg btn-sub">Valider</button></center>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <center><h3>Or</h3></center>
            <a href="http://localhost:8000/login/redirect/facebook"><button type="button" class="btn  btn-lg btn-block social-fac"><i class="fab fa-facebook-square fa-1x"></i> Facebook</button></a>
            <a href="http://localhost:8000/login/redirect/google"><button type="button" class="btn  btn-lg btn-block social-google mt-2"><i class="fab fa-google fa-1x"></i> Google</button></a>
            </form>
        	<div class="hint-text">Vous avez déja un compte ? <a href="/connexion">vers ici</a></div>
        </div>
       </div>
      </div>
    </body>
</html>

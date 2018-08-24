<?php
use GuzzleHttp\Psr7\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route return view
Route::get('/', function () {
    return view('welcome');
});
Route::get('/inscription', function () {
    return view('register');
});
Route::get('/connexion', function () {
    return view('connexion');
});
Route::get('/equipe', function () {
    if (!Auth::check()) {
        return redirect('/');
    }
    return view('equipe');
});
Route::get('/profil', function () {
    if (!Auth::check()) {
        return redirect('/');
    }
    return view('profil');
});
Route::get('/league', function () {
    if (!Auth::check()) {
        return redirect('/');
    }
    return view('league');
});
Route::get('/dashboard', function () {
    return view('Admin/dashboard');
});
Route::get('/dashboard_table', function () {
    return view('Admin/tables');
});
Route::get('/dashboard_users', function () {
    return view('Admin/tables2');
});
Route::get('/dashboard_limite', function () {
    return view('Admin/dashboard_limite');
});
Route::get('/dashboard_equipe', function () {
    return view('Admin/dashboard_equipe');
});
Route::get('/gifs', function () {
    return view('gifs');
});

//Callback Facebook Google
Route::get('login/redirect/{provider}', 'SocialAuthController@redirect');
Route::get('login/callback/{provider}', 'SocialAuthController@callback');
Route::post('register/basic', 'AuthController@register');
Route::post('login/basic', 'AuthController@login');
Route::get('/logout', function () {
   Auth::logout();
   return redirect('/');
});
Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'AuthController@confirm'
]);


//Market Request
Route::post('/GetPlayerList', 'MarketController@GetPlayersList');
Route::post('/GetPagination', 'MarketController@GetPagination');
Route::post('/BuyPlayer', 'MarketController@BuyPlayer');
Route::post('/DeletePlayer', 'MarketController@DeletePlayer');


//Admin Request
Route::post('/GetAdminPlayerList', 'AdminController@GetAdminPlayerList');
Route::post('/AdminDeadLine', 'AdminController@AdminDeadLine');
Route::post('/AddPlayerAdmin', 'AdminController@AddPlayerAdmin');
Route::post('/AdminDeleteUser', 'AdminController@AdminDeleteUser');
Route::post('/SetAdminSaveCunter', 'AdminController@SetAdminSaveCunter');
Route::post('/GetSavePlayers', 'AdminController@GetSavePlayers');
Route::post('/GlobalCalcul', 'AdminController@GlobalCalcul');

//Rewards Request
Route::post('/GetReward', 'RewardController@GetReward');

//League Request
Route::post('/CreateLeague', 'LeagueController@CreateLeague');
Route::post('/JoinLeague', 'LeagueController@JoinLeague');
Route::post('/GetMyLeague', 'LeagueController@GetMyLeague');
Route::post('/QuitMyLeague', 'LeagueController@QuitMyLeague');
Route::post('/SendMailLeague', 'LeagueController@SendMailLeague');
Route::get('league/verify/{code_league}', [
    'as' => 'confirmation_path',
    'uses' => 'LeagueController@confirmJoin'
]);

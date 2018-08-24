<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use DB;
use Input;
use Validator;
use Mail;
use App\User;
use Auth;
use Jenssegers\Date\Date;
class AuthController extends Controller
{
    public function register (Request $request)
    {
        date_default_timezone_set('Europe/Paris');
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users|min:4|max:40',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return redirect('/inscription')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = User::create(request(['name', 'email', 'password']));

        $exist_reward = DB::table("rewards")->where("email",$request->input('email'))->count();
        if($exist_reward == 0)
        {
          DB::table("rewards")->insert(
              ['email' => $request->input('email'),'created_date' => new Date('now')]
          );
        }

        $exist_compo = DB::table("compo")->where("email",$request->input('email'))->count();
        if($exist_compo == 0)
        {
          DB::table("compo")->insert(
              ['email' => $request->input('email')]
          );
        }


        //auth()->login($user);
        $confirmation_code = str_random(30);
        DB::table('users')->where('email', $request->input('email'))->update(['confirmation_code' => $confirmation_code]);
        Mail::send('emails.verification', array("confirmation_code" => $confirmation_code), function($message) {
             $message->to(Input::get('email'), Input::get('username'))
                 ->subject('Verify your email address');
        });
        return redirect('/')->with('auth_success', 'Un message avec un lien de confirmation vous a été envoyé par mail.');
    }
    public function confirm ($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            return redirect('/');
        }

        $user = User::whereConfirmationCode($confirmation_code)->first();

        if ( ! $user)
        {
            return redirect('/');
        }

        $user->verified = 1;
        $user->save();

        auth()->login($user);
        return redirect('/')->with('auth_success', 'vous venez de vous authentifié.');
    }

    function login(Request $request)
    {
       $validator = Validator::make($request->all(), [
           'password' => 'required|alphaNum',
           'email' => 'required|email',
       ]);

       if ($validator->fails()) {
           return redirect('/connexion')
                       ->withErrors($validator)
                       ->withInput();
       }

       $user_data = array(
          'email'  => $request->get('email'),
          'password' => $request->get('password')
       );
       $verfied = DB::table('users')->where('email', $request->get('email'))->value("verified");
       if($verfied == 0)
       {
          return redirect('/')->with('auth_error', 'veuillez confirmer votre adresse e-mail.');
       }
       if(Auth::attempt($user_data) && $verfied == 1)
       {
            return redirect('/')->with('auth_success', 'vous venez de vous authentifié.');
       }
       else
       {
          return redirect('/connexion')->with('erreur', 'mot de passe ou email invalide');
       }
    }

}

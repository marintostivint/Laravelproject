<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Input;
use Validator;
use Mail;
class LeagueController extends Controller
{

    public function JoinLeague(Request $request)
    {
        $email = Auth::user()->email;

        $have = DB::table("users")->where("email",$email)->value("league");
        if($have != "")
        {
          return response()->json([
              'errors' => ["vous avez déja une league quittez la pour en créer une autre."]
          ]);
        }

        $messages = [
          'token.required' => 'Le code de la league est invalide ou vide.',
          'email.unique' => 'vous avez déja une league quittez la pour en rejoindre une autre.',
        ];
        $data = Input::all();
        $data["email"] = $email;

        $validator = Validator::make($data , [
          'token' => 'required',
          'email' => 'unique:leagues_user',
        ], $messages);


        if ($validator->fails()) {
          return response()->json([
              'errors' => $validator->errors()->all()
          ]);
        }

        $exist  = DB::table("leagues")->where("tokens",$request->input("token"))->count();
        if($exist == 1)
        {
            $maximun = DB::table("leagues_user")->where("token",$request->input("token"))->count();
            $max  = DB::table("leagues")->where("tokens",$request->input("token"))->value("max");
            if($maximun < $max)
            {
                DB::table("leagues_user")->insert(["email"=> $email, 'token' => $request->input("token")]);
                return "vous avez rejoint la league";
            }
            else {
              return response()->json([
                  'errors' => ["la league est complète"]
              ]);
            }
        }
        else {
          return response()->json([
              'errors' => ["le code est invalide"]
          ]);
        }
    }
    public function GetMyLeague(Request $request)
    {
        $email = Auth::user()->email;
        $token = DB::table("leagues_user")->where("email",$email)->value("token");
        $league = DB::table("leagues")->where("tokens",$token)->value("name");

        return $league;
    }

    public function QuitMyLeague(Request $request)
    {
      $email = Auth::user()->email;
      $token = DB::table("leagues_user")->where("email",$email)->value("token");
      $owner = DB::table("leagues")->where("email",$email)->value("email");
      if($owner == $email)
      {
          $tok = DB::table("leagues")->where("email",$email)->value("tokens");
          $users = DB::table("leagues_user")->where("token",$tok)->get();
          foreach ($users as $user) {
            if($user->email != $email)
            {
                DB::table("leagues")->where("email",$email)->update(["email" => $user->email]);
                break;
            }
          }
          DB::table("leagues")->where("email",$email)->delete();
          DB::table("leagues_user")->where("email",$email)->delete();
      }
      if($token != "")
      {
          DB::table("leagues_user")->where("email",$email)->delete();
          return "vous avez quittez votre league";
      }
    }
    public function SendMailLeague(Request $request)
    {
        $email_my = Auth::user()->email;

        $messages = [
          'email.required' => 'le mail est invalide ou vide.',
        ];
        $data = Input::all();
        $validator = Validator::make($data , [
          'email' => 'required|email',
        ], $messages);


        if ($validator->fails()) {
          return response()->json([
              'errors' => $validator->errors()->all()
          ]);
        }
        $code_league= DB::table("leagues")->where("email",$email_my)->value("tokens");
        Mail::send('emails.codeleague', array("code_league" => $code_league), function($message) {
             $message->to(Input::get('email'), "Code")
                 ->subject('Rejoindre une league');
        });
        return "le mail est envoyé";
    }
    public function confirmJoin($token)
    {
        if (Auth::check()) {
            $email = Auth::user()->email;

            $exist_d  = DB::table("leagues_user")->where("email",$email)->count();
            if($exist_d != 0)
            {
                return redirect('/')->with('auth_error', 'vous avez déja une league');
            }

            $exist  = DB::table("leagues")->where("tokens",$token)->count();
            if($exist == 1)
            {
                $maximun = DB::table("leagues_user")->where("token",$token)->count();
                $max  = DB::table("leagues")->where("tokens",$token)->value("max");
                if($maximun < $max)
                {
                    DB::table("leagues_user")->insert(["email"=> $email, 'token' => $token]);
                    return redirect('/league');
                }
                else {
                  return redirect('/')->with('auth_error', 'la league est complète');
                }
            }
        }
        else {
            return redirect('/')->with('auth_error', 'vous devez être connecté pour pour rejoindre cette league');;
        }
    }
    public function CreateLeague (Request $request)
    {

        $email = Auth::user()->email;


        $messages = [
          'name.required' => 'Le nom de la league est invalide.',
          'name.unique' => 'Le nom de la league est est déja pris.',
          'email.unique' => 'vous avez déja une league quittez la pour en créer une autre.',
          'icon.required' => 'Velliez selectioner une bannière.',
        ];

        $data = Input::all();
        $data['email'] = $email;
        $validator = Validator::make($data , [
          'name' => 'required|max:70|unique:leagues',
          'icon' => 'required',
          'email' => 'unique:leagues|unique:leagues_user',
        ], $messages);


        if ($validator->fails()) {
          return response()->json([
              'errors' => $validator->errors()->all()
          ]);
        }

        $tokens = uniqid();
        DB::table('leagues')->insert(
            ['name' => $request->input("name"), 'email' => $email, 'icon' => $request->input("icon"), 'color' => $request->input("color"), 'max' => $request->input("max"), 'tokens' => $tokens]
        );
        DB::table("leagues_user")->insert(["email"=> $email, 'token' => $tokens]);

        return "Votre league a été créer.";
    }
}

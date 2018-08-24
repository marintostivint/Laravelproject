<?php

namespace App\Utility;
use DB;
use Jenssegers\Date\Date;
use Auth;
use Illuminate\Support\Collection;

class SimplifyLeague
{
    public function GetLeague()
    {
        $email = Auth::user()->email;
        $token = DB::table("leagues_user")->where("email",$email)->value("token");
        $league = DB::table("leagues")->where("tokens",$token)->value("name");
        return $league;
    }
    public function GetLeagueOwner()
    {
        $email = Auth::user()->email;
        $league = DB::table("leagues")->where("email",$email)->value("name");
        if($league!= "")
        {
            return true;
        }
        return false;
    }

    public function MesInfos()
    {
        $email = Auth::user()->email;
        $info = DB::table("users")->where("email",$email)->first();

        return $info;
    }

    public function GetListFriends ()
    {
        $email = Auth::user()->email;
        $token = DB::table("leagues_user")->where("email",$email)->value("token");

        $players = DB::table("leagues_user")->where("token",$token)->get();
        $list = array();


        foreach ($players as $pl) {

            $name = DB::table("users")->where("email",$pl->email)->value("name");
            $points = DB::table("users")->where("email",$pl->email)->value("points");
            $avatar = DB::table("users")->where("email",$pl->email)->value("provider_id");

            if($avatar != "")
            {
                $avatar = $avatar.".jpg";
            }
            $us = new UserCount();
            $us->name = htmlspecialchars($name) ;
            $us->points = $points;
            $us->avatar = $avatar;

            array_push($list, $us);
        }


        $collection = collect($list);

        $sorted = $collection->sortByDesc("points");
        return $sorted->toArray();

    }

    public function GetPlayers()
    {
        $email = Auth::user()->email;
        $token = DB::table("leagues_user")->where("email",$email)->value("token");

        $size = DB::table("leagues_user")->where("token",$token)->count();

        return $size;
    }
}
class UserCount
{
    public $name;
    public $points;
    public $avatar;
}

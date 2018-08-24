<?php

namespace App\Utility;
use DB;
use Jenssegers\Date\Date;
use Auth;

class SimplifyReward
{
    public function GetLastWinners()
    {
        $users = DB::table("rewards")->orderBy('last_date',"DESC")->limit(4)->get();
        $last = array();
        foreach ($users as $user) {
            if($user->last_date != "")
            {
                $name = DB::table("users")->where("email",$user->email)->value("name");
                array_push($last, $name);
            }
        }
        return $last;
    }

    public function GetRewards($day)
    {
        $email = Auth::user()->email;
        $user = DB::table("rewards")->where("email",$email)->first();
        if($user == null)
        {
            return false;
        }
        $used  = DB::table("rewards")->where("email",$email)->value($day);

        $date_created = new Date($user->created_date);

        $date_created->add($day);
        if($date_created->format('Y-m-d') <= Date::now()->format('Y-m-d') && $used == false)
        {
            return true;
        }
        return false;
    }
}

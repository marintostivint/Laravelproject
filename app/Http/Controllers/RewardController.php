<?php

namespace App\Http\Controllers;
use Jenssegers\Date\Date;
use Illuminate\Http\Request;
use DB;
use Auth;

class RewardController extends Controller
{
    public function GetReward(Request $request)
    {
        $day = $request->input("day");

        $email = Auth::user()->email;
        date_default_timezone_set('Europe/Paris');

        DB::table("rewards")->where("email",$email)->update([$day => 1]);
        DB::table("rewards")->where("email",$email)->update(['last_date' => Date::now()]);

        return redirect()->back();
    }
}

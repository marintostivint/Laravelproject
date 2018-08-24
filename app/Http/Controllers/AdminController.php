<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AdminController extends Controller
{

    public function GetAdminPlayerList(Request $request)
    {
        $club = $request->input("club");
        $poste = $request->input("poste");

        $players = DB::table("players")->where('club', 'like', "%".$club.'%')->where('poste', 'like', "%".$poste.'%')->get();

        return response()->json([
            'players' => $players
        ]);
    }

    public function AdminDeadLine(Request $request)
    {
        $deadline = $request->input("deadline");
        DB::table("gestion")->where("id", 1)->update(["deadline" => $deadline]);
        return "la date a été modifier";
    }

    public function AddPlayerAdmin(Request $request)
    {
        $name = $request->input("name");
        $poste = $request->input("poste");
        $club = $request->input("club");
        $price = $request->input("price");
        if($name == "" ||$poste == "" || $club == "" || $price == "")
        {
            return "";
        }
        $exist = DB::table('players')->where("name",$name)->count();
        if($exist >= 1)
        {
            return "vous avez deja ce joueur";
        }
        DB::table('players')->insert(
            ['name' => $name, 'poste' => $poste , 'club' => $club , 'price' => $price]
        );
        return "vous avez ajouter un joueur";
    }

    public function GlobalCalcul(Request $request)
    {
        $players = DB::table("comptable")->get();

        $list = [];
        $global = [];
        foreach ($players as $pl) {
            $list[] = json_decode(strval($pl->data),true);
        }

        for ($i=0; $i < count($list); $i++) {
          if(empty($list[$i]) === false)
          {
              for ($r=0; $r < 15; $r++)
              {
                if(!empty($list[$i]['rows'][$r]))
                {
                    $global[$list[$i]['rows'][$r]['name']] = $list[$i]['rows'][$r]['total'];
                }
              }
          }
        }
        $users = DB::table("users")->get();

        $user_count = [];
        $end = [];
        foreach ($users as $user) {
            $user_c = new UserCount;
            $user_c->email = $user->email;
            $user_c->points = $user->points;
            $user_count[] = $user_c;
        }
        foreach ($user_count as $pl_c) {
            $players = DB::table("compo")->where("email",$pl_c->email)->value("players");
            $players = explode("/",$players);
            $pl_c->points += $this->GetPlayerNametest($global,$players);
            if($pl_c->points <= 0)
            {
                $pl_c->points = 0;
            }
            $end[] = $pl_c;
        }
        foreach ($end as $user) {
            DB::table("users")->where("email",$user->email)->update(["points" => $user->points]);
        }
        DB::table("comptable")->where("equipe","All")->update(["data" => json_encode($end)]);
    }
    public function GetPlayerNametest($global,$players)
    {
        $points = [];
        foreach ($players as $pl) {
            $data = explode(":", $pl);
            $name_pl = $data[0];
            $points[] = $this->GetPlayerValueCount($global,$name_pl);
        }
        return array_sum ($points);
    }
    public function GetPlayerValueCount($table,$name)
    {
        foreach ($table as $key => $value) {
            if($key == $name)
            {
                return $value;
            }
        }
        return 0;
    }
    public function SetAdminSaveCunter(Request $request)
    {
        $equipe = $request->input("club");
        DB::table("comptable")->where("equipe",$equipe)->update(["data" => json_encode($request->input("players"))]);
    }
    public function GetSavePlayers(Request $request)
    {
        $equipe = $request->input("club");
        $data = DB::table("comptable")->where("equipe",$equipe)->value("data");

        return $data;
    }
    public function AdminDeleteUser(Request $request)
    {
        $id = $request->input("id");
        DB::table("users")->where("id",$id)->delete();

        return redirect()->back();
    }
}
class UserCount
{
    public $email = "";
    public $points = 0;
}

<?php

namespace App\Utility;
use DB;
use Jenssegers\Date\Date;
use Auth;

class SimplifyAdmin
{
    public function GetAllTask()
    {
        $task = DB::table('tasks')->get();
        return $task;
    }

    public function GetLastUsers()
    {
        $users = DB::table("comptable")->where("equipe","All")->value("data");
        $collection = collect(json_decode($users));

        $sorted = $collection->sortByDesc('points');
        return array_slice($sorted->toArray(), 0, 10);
    }
    public function GetEquipe($id)
    {
      switch ($id) {
        case 0:
          return "Agen";
        break;
        case 1:
          return "Bordeaux";
        break;
        case 2:
          return "Castres Olympique";
        break;
        case 3:
          return "Grenoble Rugby";
        break;
        case 4:
          return "Stade Rochelais";
        break;
        case 5:
          return "Lyon Olympique";
        break;
        case 6:
          return "Montpellier";
        break;
        case 7:
          return "Stade Francais";
        break;
        case 8:
          return "Section Paloise";
        break;
        case 9:
          return "Perpigan";
        break;
        case 10:
          return "Racing 92";
        break;
        case 11:
          return "Club Toulonnais";
        break;
        case 12:
          return "Stade Toulousain";
        break;
        case 13:
          return "ASM Clermont";
        break;
      }
    }
    public function GetAllUsers()
    {
        $users = DB::table('users')->orderBy('updated_at','DESC')->paginate(10);
        foreach ($users as $user) {
            if($user->league == "")
            {
                $user->league  = "<label style='color:red'>Aucune</label>";
            }
        }
        return $users;
    }
    public function GetAllLeagues()
    {
        $leagues = DB::table('leagues')->paginate(10);
        return $leagues;
    }
    public function GetAllPlayers($club,$poste)
    {
      $players = DB::table('players')->where('club', 'like', "%".$club.'%')->where('club', 'like', "%".$poste.'%')->orderBy('club','ASC')->get();
      return $players;
    }
}

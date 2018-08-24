<?php

namespace App\Utility;
use DB;
use Jenssegers\Date\Date;
use Auth;

class SimplifyEquipe
{
    //Renvoie poste grace à l'id
    public function GetPostById($id)
    {
        $email = Auth::user()->email;
        $players = DB::table('compo')->where('email', $email)->value("players");
        if($players == "")
        {
            return $this->GetPosteIdSwitch($id);
        }
        $players = explode("/", $players);
        foreach ($players as $pl) {
            $data = explode(":", $pl);
            $name = $data[0];
            $position = $data[1];

            if($position == $id)
            {
                return $name;
            }
        }

        return $this->GetPosteIdSwitch($id);

    }
    public function GetPlayerById($id)
    {
        $email = Auth::user()->email;
        $players = DB::table('compo')->where('email', $email)->value("players");
        if($players == "")
        {
            return null;
        }
        $players = explode("/", $players);
        foreach ($players as $pl) {
            $data = explode(":", $pl);
            $name = $data[0];
            $position = $data[1];
            if($position == $id)
            {
                return DB::table('players')->where('name', $name)->first();
            }
        }
    }
    public function GetPostByIdImagemobile($id)
    {
        $email = Auth::user()->email;
        $players = DB::table('compo')->where('email', $email)->value("players");
        if($players == "")
        {
            return "/images/player.png";
        }
        $players = explode("/", $players);
        foreach ($players as $pl) {
            $data = explode(":", $pl);
            $name = $data[0];
            $position = $data[1];
            if($position == $id)
            {
                $club = DB::table('players')->where('name', $name)->value("club");
                $club = preg_replace('/\s+/', '', $club);
                if($club != "")
                {
                    return "/images/".strtolower($club).".png";
                }
            }
        }
        return "/images/player.png";
    }
    public function GetMoney()
    {
        $email = Auth::user()->email;
        $money = DB::table('users')->where('email', $email)->value("money");
        return $money;
    }
    public function GetPostByIdImage($id)
    {
        $email = Auth::user()->email;
        $players = DB::table('compo')->where('email', $email)->value("players");
        if($players == "")
        {
            return "/images/player_add.png";
        }
        $players = explode("/", $players);
        foreach ($players as $pl) {
            $data = explode(":", $pl);
            $name = $data[0];
            $position = $data[1];
            if($position == $id)
            {
                $club = DB::table('players')->where('name', $name)->value("club");
                $club = preg_replace('/\s+/', '', $club);
                if($club != "")
                {
                    return "url(/images/".strtolower($club).".png)";
                }
            }
        }
        return "/images/player_add.png";
    }
    public function GetPosteIdSwitch ($id)
    {
        switch ($id) {
          case 0:
              return "Arrière";
          break;

          case 1:
              return "Ailier";
          break;

          case 2:
              return "Centre";
          break;

          case 3:
              return "Centre";
          break;

          case 4:
              return "Ailier";
          break;

          case 5:
              return "Ouverture";
          break;

          case 6:
              return "Melée";
          break;

          case 7:
              return "3emeligne";
          break;

          case 8:
              return "3emeligne";
          break;

          case 9:
              return "3emeligne";
          break;

          case 10:
              return "2emeligne";
          break;

          case 11:
              return "2emeligne";
          break;

          case 12:
              return "Pilier";
          break;

          case 13:
              return "Talonneur";
          break;

          case 14:
              return "Pilier";
          break;
        }
    }
}

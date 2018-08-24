<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use DB;
class MarketController extends Controller
{
    public function GetPlayersList(Request $request)
    {
        $page = $request->input("page");
        $poste = $request->input("poste");
        $name_t = $request->input("name");
        $club_t = $request->input("club");

        $players = DB::table('players')->offset(($page - 1) * 9)->limit(9)->where('club', 'like', "%".$club_t.'%')->where('poste', 'like', "%".$poste.'%')->where('name', 'like', "%".$name_t.'%')->get();
        $compo = $this->GetMyCompo();
        return response()->json([
            'players' => $players,
            'compo' => $compo
        ]);
    }
    public function GetPagination(Request $request)
    {

        $page_up = $request->input("page_up");
        $poste = $request->input("poste");
        $name_t = $request->input("name");
        $club_t = $request->input("club");

        $max = DB::table('players')->where('club', 'like', "%".$club_t.'%')->where('poste', 'like', "%".$poste.'%')->where('name', 'like', "%".$name_t.'%')->count();
        $max = ceil($max/10);

        return response()->json([
            'max' => $max
        ]);
    }

    public function BuyPlayer(Request $request)
    {
        $name = $request->input("name");
        $id = $request->input("id");
        $poste = $request->input("poste");

        $player = DB::table('players')->where("name",$name)->first();

        if($player != null)
        {
            if($player->poste != $poste)
            {
                exit("une erreur c'est produite");
            }
            $compo = strval ($this->GetMyCompo()->players);
            if (strpos($compo, ":".strval($id)) !== false) {
                exit("une erreur c'est produite");
            }
            if (strpos($compo, $name) === false) {
                if($this->VerifyfiveNational($player->club) == false)
                {
                    if($compo != "")
                    {
                      $compo = $compo."/".$name.":".$id;
                      $this->UpdateMyCompo($compo);
                    }
                    if($compo == "")
                    {
                      $compo = $name.":".$id;
                      $this->UpdateMyCompo($compo);
                    }
                    $money = $this->UpdateMoney($player->price);
                    $player->club = strtolower(preg_replace('/\s+/', '', $player->club));
                    return response()->json([
                        'player' => $player,
                        'money' =>$money
                    ]);
                }
            }
            else {
              exit("vous avez déja ce joueur dans votre équipe");
            }
        }
    }
    function DeletePlayer(Request $request)
    {
        $email = Auth::user()->email;
        $money = DB::table('users')->where('email', $email)->value("money");
        $name = $request->input("name");

        $player = DB::table('players')->where("name",$name)->first();
        if($player != null)
        {
            $compo = strval ($this->GetMyCompo()->players);
            if (strpos($compo, strval($name)) !== false) {

                $price = $player->price;
                $total = $money + $price;

                $list = explode("/", $compo);
                if(sizeof($list) == 1)
                {
                  DB::table('compo')->where('email', $email)->update(["players" => ""]);
                  DB::table('users')->where('email', $email)->update(["money" => $total]);
                  return response()->json([
                      'poste' => $player->poste,
                      'money' => $total
                  ]);
                }
                $ind = 0;
                foreach ($list as $pl) {
                    $data = explode(":", $pl);
                    $n = $data[0];
                    if($n == $name)
                    {
                        if($ind == 0)
                        {
                            $compo = strval(str_replace($pl."/","",$compo));
                        }
                        else {
                            $compo = strval(str_replace("/".$pl,"",$compo));
                        }
                        DB::table('compo')->where('email', $email)->update(["players" => $compo]);
                        DB::table('users')->where('email', $email)->update(["money" => $total]);
                        return response()->json([
                            'poste' => $player->poste,
                            'money' => $total
                        ]);
                    }
                    $ind++;
                }
            }
            else {
                exit("une erreur est survenue");
            }
        }
    }

    public function UpdateMoney($price)
    {
        $email = Auth::user()->email;
        $money = DB::table('users')->where('email', $email)->value("money");
        $total = ($money- $price);
        if($total >= 0)
        {
            DB::table('users')->where('email', $email)->update(["money" => $total]);
            return $total;
        }
        return exit("vous n'avez plus assez d'argent");
    }
    function VerifyfiveNational ($club)
    {
        $compo = strval ($this->GetMyCompo()->players);
        $list = explode("/", $compo);
        $total = 0;
        if($compo == "")
        {
            return 0;
        }
        foreach ($list as $pl) {
            $date = explode(":", $pl);
            $name = $date[0];
            $player = DB::table('players')->where("name",$name)->first();
            if($player->club == $club)
            {
                $total ++;
            }
        }
        if($total >= 5 )
        {
            exit("Vous avez trop de joueur de cette équipe");
        }
        return false;
    }
    public function GetMyCompo()
    {
        $email = Auth::user()->email;
        $compo = DB::table('compo')->where("email",$email)->first();
        return $compo;
    }
    public function UpdateMyCompo($compo)
    {
        $email = Auth::user()->email;
        $compo = DB::table('compo')->where("email",$email)->update(["players" => $compo]);
    }
}

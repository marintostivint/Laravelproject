<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'say:AddUser{count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $message = $this->GenerateRandomUser($this->argument('count'));
        $this->info($message);
    }
    public function GenerateRandomUser($number)
    {
        $players = DB::table("players")->get();
        foreach ($players as $pl) {
          $first = substr($pl->name,0,1);
          $data  = explode(" ", $pl->name);
          if(!empty($data[1] ))
          {
            $data[1] = mb_strtolower  (strval ($data[1]));
            $pl->name = $first.".".strval($data[1]);
            DB::table("players")->where("id",$pl->id)->update(["name" => $pl->name]);
          }
        }
        return "vous venez d'ajouter".$number." joueurs";
    }
    function GetPosteById($id)
    {
        switch ($id)
      	{
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
    public function GetClub ($id)
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Laravel\Socialite\Contracts\Provider;
use App\User;
use Auth;
use Jenssegers\Date\Date;
use DB;
use File;

class SocialAuthController extends Controller
{
    public function callback($provider)
    {

        $user = $this->createOrGetUser(Socialite::driver($provider));

        auth()->login($user);

        return redirect()->to('/');
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    private function createOrGetUser(Provider $provider)
    {

        $providerUser = $provider->user();

        $providerName = class_basename($provider);

        $user_check = DB::table('users')->where("email",$providerUser->getEmail())->count();
        $user_check_v = User::where('email', $providerUser->getEmail())->first();

        $fileContents = file_get_contents($providerUser->getAvatar());
        File::put(public_path() . '/storage/profiles/' . $providerUser->getId() . ".jpg", $fileContents);
        
        if($user_check == 1)
        {
            $user_check_v->provider_id = $providerUser->getId();
            $user_check_v->provider = $providerName;
            $user_check_v->verified = true;
            $user_check_v->save();
            return $user_check_v;
        }

        $user = User::whereProvider($providerName)
            ->whereProviderId($providerUser->getId())
            ->first();

        if (!$user) {
            $user = User::create([
                'email' => $providerUser->getEmail(),
                'name' => $providerUser->getName(),
                'provider_id' => $providerUser->getId(),
                'provider' => $providerName,
            ]);


            $exist_reward = DB::table("rewards")->where("email",$providerUser->getEmail())->count();
            if($exist_reward == 0)
            {
              DB::table("rewards")->insert(
                  ['email' => $providerUser->getEmail(),'created_date' => new Date('now')]
              );
            }

            $exist_compo = DB::table("compo")->where("email",$providerUser->getEmail())->count();
            if($exist_compo == 0)
            {
              DB::table("compo")->insert(
                  ['email' => $providerUser->getEmail()]
              );
            }
        }

        return $user;
    }
}

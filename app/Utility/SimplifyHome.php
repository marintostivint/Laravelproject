<?php

namespace App\Utility;
use DB;
use Jenssegers\Date\Date;
use Auth;

class SimplifyHome
{
    //Renvoie article grace à l'id
    public function GetArticleList()
    {
        date_default_timezone_set('Europe/Paris');
        $articles = DB::table('articles')->limit(3)->orderBy('date', 'desc')->get();

        foreach ($articles as $article)
        {
            $date = new Date($article->date);
            if(Date::now()->hour - $date->hour <= 3 && Date::now()->day - $date->day == 0 && Date::now()->month - $date->month == 0 && Date::now()->year - $date->year == 0)
            {
                $article->new = "1";
            }
        }

        return $articles;
    }

    public function GetArticleById($id)
    {
        $article = DB::table('articles')->where("id",$id)->first();
        return $article;
    }
    public function GetArticleDateId($id)
    {
        date_default_timezone_set('Europe/Paris');

        $article = $this->GetArticleById($id);

        // Date::now()->format('Y-m-d H:i');
        $date = new Date($article->date);

        return $date->ago()." | ".$article->owner;
    }

    public function LoggedTestReturnView ()
    {
        if (!Auth::check()) {
            return redirect('/');
        }
    }
}

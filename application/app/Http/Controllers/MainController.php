<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        //ici, je vérifie si je récupère bien les catégories de l'article qui a pour id 10
        $article = Article::find(10);
        $categories = $article->categories;
        dd($categories);
        return view('main.home');
    }
}

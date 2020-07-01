<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        //ici je vérifie le nombre d'article qui appartient a la catégorie qui a pour id 1
        $category = Category::find(1);
        $articles = $category->articles;

        dd($articles);
        return view('main.home');
    }
}

<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        return view('main.home');
    }
}

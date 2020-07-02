<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();


        return view('articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        //Ici j'instancie mon Model
        $article = new Article();
        //je lui affilie les valeurs que je récupère avec l'objet Request
        $article->name = $request->input('name');
        $article->color = $request->input('color');
        $article->size = $request->input('size');
        $article->price = $request->input('price');
//        $article->category = $request->input('category');
        $article->description = $request->input('description');
        $article->categories()->attach($article->id);

        //ici, je m'occupe du traitement  de l'image
        $image = $request->file('image');
        // je récupère le nom complet de l'image
        $imageFullName = $image->getClientOriginalName();
        //ici je récupère le nom de l'image sans avoir l'extension
        $imageName = pathinfo($imageFullName, PATHINFO_FILENAME);
        //maintenant je veux que l'extension
        $extension = $image->getClientOriginalExtension();
        //pour éviter d'avoir des doublons dans les noms des fichiers je génère une date en début de nom
        $file = time() . '_' . $imageName . '.' . $extension;
        //maintenant je vais stocker l'image uploader dans mon storage que j'ai linké avec la
        // commande php artisan storage:link, ainsi on la retrouve public/storage/articles/
        $image->storeAs('public/articles/', $file);

        // ici j'attribue le nom de l'image à mon article
        $article->image = $file;
        // et je sauvegarde dans la bdd
        $article->save();

        // ensuite je redirige sur la vue de tout les articles
        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

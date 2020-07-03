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
        //ici je créé une variable avec toutes les catégories afin de l'envoyer à la vue
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
        //Ici je récupère la cat présente en bdd via sa valeur
        $firstCategoryArticle = Category::find($request->input('category_first'));
        $secondCategoryArticle = Category::find($request->input('category_second'));
        //ici je récupère uniquement son Id afin de l'attaché à l'article en création dans la table pivot article_category
        $firstCategoryId = $firstCategoryArticle['id'];
        $secondCategoryId = $secondCategoryArticle['id'];
        //Ici j'instancie mon Model
        $article = new Article();
        //je lui affilie les valeurs que je récupère avec l'objet Request
        $article->name = $request->input('name');
        $article->color = $request->input('color');
        $article->size = $request->input('size');
        $article->price = $request->input('price');
        $article->description = $request->input('description');

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

        //Ici j'attache article_id à la category_id dans la table pivot
        //mais je gère au cas où la possibilté de que le choix de la cat 1 ou cat 2 soit null ou
        if ($firstCategoryId === null){
            $article->categories()->attach($secondCategoryId);
        }elseif ($secondCategoryId === null){
            $article->categories()->attach($firstCategoryId);
        }else{
            $article->categories()->attach([$firstCategoryId, $secondCategoryId,]);
        }
        // ensuite je redirige sur la vue de tout les articles
        return redirect()->route('articles.index')->with('success', 'Votre ajout a été effectué avec succès !');
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
        $categories = Category::all();
        $article = Article::find($id);
        return view('articles.edit', compact('article', 'categories'));
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
//        dd($id, $request);
        $article = Article::find($id);
        $article->categories()->detach();
        $article->name = $request->input('name');
        $article->color = $request->input('color');
        $article->size = $request->input('size');
        $article->price = $request->input('price');
        $article->description = $request->input('description');

        $categoryArticle = Category::find($request->input('category'));
        $categoryId = $categoryArticle['id'];

//        Une condition pour remplacer si il y a une nouvelle image
        if ($request->file('image')) {
            $image = $request->file('image');
            $imageFullName = $image->getClientOriginalName();
            $imageName = pathinfo($imageFullName, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $file = time() . '_' . $imageName . '.' . $extension;
            $image->storeAs('public/articles/', $file);
            // ici on remplace donc l'image par la nouvelle
            $article->image = $file;
        }

        $article->categories()->attach($categoryId);
        $article->save();

        return redirect()->route('articles.index')->with('success', 'Vos modifications ont été effectué avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'L\'article a bien été supprimé');
    }
}

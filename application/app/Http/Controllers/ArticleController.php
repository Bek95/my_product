<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\src\Domain\Article\Service\ArticleService;
use App\src\Domain\Category\Service\CategoryService;
use App\src\Domain\Utilities\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    private $categoryService;
    private $articleService;
    private $imageManager;

    public function __construct(CategoryService $categoryService, ArticleService $articleService, ImageManager $imageManager)
    {
        $this->categoryService = $categoryService;
        $this->articleService = $articleService;
        $this->imageManager = $imageManager;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $articles = $this->articleService->articles();
        $categories = $this->categoryService->categories();

        return view('articles.index')->with([
            'categories' => $categories,
            'articles' => $articles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //ici je créé une variable avec toutes les catégories afin de l'envoyer à la vue
        $categories = $this->categoryService->categories();

        return view('articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $categories = $this->categoryService->categories();

        $validator = Validator::make($request->all(), [
            'checkboxCategories' => 'required|min:1|max:2',
            'name' => 'required|max:50',
            'color' => 'required|max:50',
            'size' => 'required|max:50',
            'price' => 'required',
            'description' => 'required|max:255',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect('articles/new')
                ->withErrors($validator)
                ->withInput()->with([
                    'categories' => $categories,
                ]);
        }

        $dataRequest = $request->all();
        $tabCategories = $dataRequest['checkboxCategories'];

        $image = $request->file('image');
        $file = $this->imageManager->imageStorage($image);

        $data = [
            'name' => $request->input('name'),
            'color' => $request->input('color'),
            'size' => $request->input('size'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image' => $file, // ici j'attribue le nom de l'image à mon article
        ];

        $res = $this->articleService->createArticle($data, $tabCategories);

        if ($res != true){
            $fails = 'un problème est survenu ! ';
            return redirect()->back()->with([
                'fails' => $fails,
            ]);
        }

        return redirect()->route('articles.index')->with('success', 'Votre ajout a été effectué avec succès !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->categoryService->categories();
        $article = Article::find($id);
        Log::info('L\'id de l\'article est : ' . $id );

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
        $article = Article::find($id);

        Log::info('L\'article a pour id : ' . $id );

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
        Log::info('L\' article ayant l\'id . (id) a été supprimé');
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'L\'article a bien été supprimé');
    }

}

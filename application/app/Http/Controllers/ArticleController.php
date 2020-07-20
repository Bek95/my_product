<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\src\Domain\Article\Service\ArticleService;
use App\src\Domain\Category\Service\CategoryService;
use App\src\Domain\Utilities\ImageManager;

class ArticleController extends Controller
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * @var ArticleService
     */
    private $articleService;

    /**
     * @var ImageManager
     */
    private $imageManager;

    /**
     * ArticleController constructor.
     *
     * @param CategoryService $categoryService
     * @param ArticleService $articleService
     * @param ImageManager $imageManager
     */
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //ici je créé une variable avec toutes les catégories afin de l'envoyer à la vue
        $categories = $this->categoryService->categories();

        return view('articles.create', compact('categories'));
    }

    /**
     * @param ArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ArticleRequest $request)
    {
        $categories = $this->categoryService->categories();
        $dataValidated = $request->validated();
        $image = $request->file('image');

        $res = $this->articleService->createArticle($dataValidated, $image);

        if ($res != true){
            $fails = 'un problème est survenu ! ';
            return redirect()->back()->with([
                'fails' => $fails,
                'categories' => $categories,
            ]);
        }

        return redirect()->route('articles.index')->with('success', 'Votre ajout a été effectué avec succès !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(string $id)
    {
        $categories = $this->categoryService->categories();
        $article = $this->articleService->findArticleById($id);
        $articleCats = $article->categories;// ici je récupère la ou les catégorie(s) lié à l'article

        return view('articles.edit')->with([
            'article' => $article,
            'categories' => $categories,
            'articleCats' => $articleCats,
        ]);
    }

    /**
     * @param ArticleRequest $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ArticleRequest $request, string $id)
    {
        $dataValidated = $request->validated();
        //  Une condition pour remplacer si il y a une nouvelle image
        if ($request->file('image')) {
            $file = $request->file('image');
        }

        $res = $this->articleService->updateArticle($id, $dataValidated, $file ?? null);

        if ($res != true){
            $fails = 'un problème est survenu ! ';
            return redirect()->back()->with([
                'fails' => $fails,
            ]);
        }

        return redirect()->route('articles.index')->with('success', 'Vos modifications ont été effectué avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $res = $this->articleService->destroyArticle($id);

        if ($res == true) {
            return redirect()->route('articles.index')->with('success', 'L\'article a bien été supprimé');
        }else {
            $fails = 'un problème est survenu ! ';
            return redirect()->back()->with([
                'fails' => $fails,
            ]);
        }
    }

}

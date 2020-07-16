<?php

namespace App\Http\Controllers;

use App\src\Domain\Article\Service\ArticleService;
use App\src\Domain\Category\Service\CategoryService;
use App\src\Domain\Utilities\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'description' => 'required|max:455',
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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(string $id)
    {
        $categories = $this->categoryService->categories();
        $article = $this->articleService->findArticleById($id);

        return view('articles.edit', compact('article', 'categories'));
    }

    /**
     * * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'checkboxCategories' => 'required|min:1|max:2',
            'name' => 'required|max:50',
            'color' => 'required|max:50',
            'size' => 'required|max:50',
            'price' => 'required',
            'description' => 'required|max:455',
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

        $data = [
            'name' => $request->input('name'),
            'color' => $request->input('color'),
            'size' => $request->input('size'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
        ];

        //  Une condition pour remplacer si il y a une nouvelle image
        if ($request->file('image')) {
            $file = $this->imageManager->imageStorage($request->file('image'));
            $data = [
                'name' => $request->input('name'),
                'color' => $request->input('color'),
                'size' => $request->input('size'),
                'price' => $request->input('price'),
                'description' => $request->input('description'),
                'image' => $file,
            ];
        }

        $res = $this->articleService->updateArticle($id, $data, $tabCategories);

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
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
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

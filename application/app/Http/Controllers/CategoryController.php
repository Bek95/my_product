<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\src\Domain\Category\Service\CategoryService;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * CategorieController constructor.
     *
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryService->categories();

        return view('categories.index', compact('categories'));
    }

    /**
     *  Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(CategoryRequest $request)
    {
        $validateData = $request->validated();

        $res = $this->categoryService->createCategory($validateData);

        if ($res === false) {
            $message = 'Cette catégorie existe';
            return view('categories.create', compact('message'));
        }

        return redirect()->route('categories.index')->with('success', 'Votre catégorie a été créé avec succès');
    }

    /**
     *  Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showArticleByCategory($id)
    {
        $category = $this->categoryService->findCategoryById($id);
        Log::info('la catégorie a pour id : ' . $category);
        $articles = $category->articles;

        return view('categories.show')->with([
            'articles' => $articles,
            'category' => $category,
        ]);
    }

    /**
     *  * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $category = $this->categoryService->findCategoryById($id);

        if ($category === null){
            return view('categories.index')->with('errors', 'Cette catégorie n\'existe pas !');
        }

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Exceptions\Category\CategoryNotFoundException
     */

    public function update(CategoryRequest $request, $id)
    {
        $validateData = $request->validated();
        $this->categoryService->updateCategory($id, $validateData);

        return redirect()->route('categories.index')->with('success', 'Votre modification a été effecuté avec succès !');
    }

}

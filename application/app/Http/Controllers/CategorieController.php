<?php

namespace App\Http\Controllers;

use App\Category;
use App\src\Domain\Category\Service\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CategorieController extends Controller
{
    private $categoryService;

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
        $categories = Category::all();

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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'name' => 'required|string|max:60',
        ]);

        if ($validateData->fails()) {
            return redirect('categories/new')
                ->withErrors($validateData)
                ->withInput();
        }
        $data = $request->all();

        $res = $this->categoryService->createCategory($data);

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
        $category = Category::find($id);
        Log::info('la catégorie a pour id : ' . $category);
        $articles = $category->articles;

        return view('categories.show', compact('articles', 'category'));
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
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $validateData = Validator::make($request->all(), [
            'name' => 'required|string|max:60',
        ]);

        if ($validateData->fails()) {
            return redirect('categories/new')
                ->withErrors($validateData)
                ->withInput();
        }

        $data = $request->all();
        $this->categoryService->updateCategory($id, $data);

        return redirect()->route('categories.index')->with('success', 'Votre modification a été effecuté avec succès !');
    }

}

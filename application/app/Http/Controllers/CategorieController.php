<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategorieController extends Controller
{
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
        $data = $this->validate($request, [
            'name' => 'required|string|max:50',
        ]);

        $category = new Category();
        $value = $category::where('name', $data['name'])->first();

        if (strtolower($data['name']) === strtolower($value['name'])){
            $message = "cette catégorie existe";

            return view('categories.create', compact('message'));
        }else{
            $category->name = $data['name'];
            $category->save();

            return redirect()->route('categories.index')->with('success', 'Votre catégorie a été créé avec succès');
        }
    }

    /**
     *  Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
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
        $category = Category::find($id);
        Log::info('la catégorie a pour id : ' . $category);

        return view('categories.edit', compact('category'));
    }

    /**
     * * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'name' => 'required|string|max:50',
        ]);

        $category = Category::find($id);
        $category->name = $data['name'];
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Votre catégorie a été modifié avec succès');
    }

}

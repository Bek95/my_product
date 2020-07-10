<?php


namespace App\src\Infrastructure\Category\Repository;


use App\Category;

class CategoryRepository
{
    private $categoryModel;

    public function __construct(Category $categoryModel)
    {
        $this->categoryModel = $categoryModel;
    }

    public function createCategory(array $data)
    {
        $category = new Category();
        $value = $category::where('name', $data['name'])->first();

        if (strtolower($data['name']) === strtolower($value['name'])){
            $res = false;

        }else{
            $category->name = $data['name'];
            $res = $category->save();
        }

        return $res;
    }

    public function findCategorybyId($id)
    {
        return $this->categoryModel::find($id);
    }

    public function updateCategory($id, $data)
    {
        $category = $this->findCategorybyId($id);
        $category->name = $data['name'];

        return $category->save();
    }

}

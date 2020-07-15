<?php


namespace App\src\Infrastructure\Category\Repository;


use App\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Object_;

class CategoryRepository
{
    /**
     * @var Category
     */
    private $categoryModel;

    /**
     * @var Category
     */
    private $category;

    /**
     * CategoryRepository constructor.
     *
     * @param Category $categoryModel
     */
    public function __construct(Category $categoryModel)
    {
        $this->categoryModel = $categoryModel;
        $this->category = new Category();
    }

    /**
     * @return Collection
     */
    public function categories(): Collection
    {
         return $this->categoryModel->all();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function createCategory(array $data): bool
    {
        $category = $this->category;
        $value = $category::where('name', $data['name'])->first();

        if (strtolower($data['name']) === strtolower($value['name'])){
            $res = false;

        }else{
            $category->name = $data['name'];
            $res = $category->save();
        }
        return $res;
    }

    /**
     * @param string $id
     * @return Model
     */
    public function findCategorybyId(string $id): Model
    {
        return $this->categoryModel::find($id);
    }

    /**
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function updateCategory(string $id, array $data): bool
    {
        $category = $this->findCategorybyId($id);
        $category->name = $data['name'];

        return $category->save();
    }

}

<?php


namespace App\src\Infrastructure\Category\Repository;


use App\Category;
use App\Exceptions\Category\CategoryNotCreatedException;
use App\Exceptions\Category\CategoryNotFoundException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

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
     * @param string $name
     * @return bool
     * @throws CategoryNotCreatedException
     */
    public function createCategory(string $name): bool
    {
        try {
            $category = $this->category;
            $value = $category::where('name', $name)->first();
            Log::info('CATEGORY NAME : ' . $value);

            if (strtolower($name) === strtolower($value['name'])){
                $res = false;
            }else{
                $category->name = $name;
                $res = $category->save();
            }

            return $res;
        }catch (\Exception $exception){
            throw new CategoryNotCreatedException('CATEGORY NOT CREATED ');
        }
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
     * @param string $name
     * @return bool
     * @throws CategoryNotFoundException
     */
    public function updateCategory(string $id, string $name): bool
    {
        try {
            $category = $this->findCategorybyId($id);
            $category->name = strtolower($name);

            return $category->save();
        }catch (\Exception $exception) {

            throw new CategoryNotFoundException('CATEGORY WITH THE ID : ' . $id . ' NOT FOUND' );
        }
    }

}

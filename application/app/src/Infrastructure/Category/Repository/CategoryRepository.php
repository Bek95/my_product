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
     * @param array $data
     * @return bool
     * @throws CategoryNotCreatedException
     */
    public function createCategory(array $data): bool
    {
        try {
            $category = $this->category;
            $value = $category::where('name', $data['name'])->first();
            Log::info('CATEGORY NAME : ' . $value);

            if (strtolower($data['name']) === strtolower($value['name'])){
                $res = false;

            }else{
                $category->name = $data['name'];
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
     * @param array $data
     * @return bool
     * @throws CategoryNotFoundException
     */
    public function updateCategory(string $id, array $data): bool
    {
        try {
            $category = $this->findCategorybyId($id);
            $category->name = $data['name'];

            return $category->save();
        }catch (\Exception $exception) {

            throw new CategoryNotFoundException('CATEGORY WITH THE ID : ' . $id . ' NOT FOUND' );
        }
    }

}

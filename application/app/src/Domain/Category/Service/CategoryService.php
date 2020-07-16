<?php


namespace App\src\Domain\Category\Service;


use App\src\Infrastructure\Category\Repository\CategoryRepository;

class CategoryService
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param array $data
     * @return bool
     * @throws \App\Exceptions\Category\CategoryNotCreatedException
     */
    public function createCategory(array $data)
    {
        return $this->categoryRepository->createCategory($data);
    }

    /**
     * @param string $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findCategoryById(string $id)
    {
        return $this->categoryRepository->findCategorybyId($id);
    }

    /**
     * @param string $id
     * @param array $data
     * @return bool
     * @throws \App\Exceptions\Category\CategoryNotFoundException
     */
    public function updateCategory(string $id, array $data)
    {
        return $this->categoryRepository->updateCategory($id, $data);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function categories()
    {
        return $this->categoryRepository->categories();
    }

}

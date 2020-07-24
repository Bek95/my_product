<?php


namespace App\src\Domain\Category\Service;


use App\Category;
use App\src\Domain\Category\Repository\CategoryRepositoryInterface;
use Illuminate\Support\Collection;

class CategoryService
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * CategoryService constructor.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function createCategory(array $data): bool
    {
        $name = $data['name'];

        return $this->categoryRepository->createCategory($name);
    }

    /**
     * @param string $id
     * @return Category
     */
    public function findCategoryById(string $id): Category
    {
        return $this->categoryRepository->findCategorybyId($id);
    }

    /**
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function updateCategory(string $id, array $data): bool
    {
        $name = $data['name'];
        return $this->categoryRepository->updateCategory($id, $name);
    }

    /**
     * @return Collection
     */
    public function categories(): Collection
    {
        return $this->categoryRepository->categories();
    }

}

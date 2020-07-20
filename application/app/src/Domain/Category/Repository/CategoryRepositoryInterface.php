<?php


namespace App\src\Domain\Category\Repository;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface CategoryRepositoryInterface
{
    /**
     * @return Collection
     */
    public function categories(): Collection;

    /**
     * @param string $name
     * @return bool
     */
    public function createCategory(string $name): bool;

    /**
     * @param string $id
     * @return Model
     */
    public function findCategorybyId(string $id): Model;

    /**
     * @param string $id
     * @param string $name
     * @return bool
     */
    public function updateCategory(string $id, string $name): bool;

}

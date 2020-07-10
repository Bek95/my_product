<?php


namespace App\src\Infrastructure\Category\Hydrator;


use App\Category;
use App\src\Domain\Category\Entity\CategoryEntity;

class CategoryHydrator
{
    public function hydrate(Category $categoryModel)
    {
        $entity = new CategoryEntity();
        $entity->setId($categoryModel->id);
        $entity->setName($categoryModel->name);
        $entity->setDeletedAt($categoryModel->deleted_at);
        $entity->setCreatedAt($categoryModel->created_at);
        $entity->setUpdatedAt($categoryModel->updated_at);

        return $entity;
    }

//    public function model(Category $categoryModel, $params)
//    {
//        $categoryModel->name = $params['name'];
//        return $categoryModel->save();
//    }




}

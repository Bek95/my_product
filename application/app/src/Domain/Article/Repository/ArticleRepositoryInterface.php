<?php


namespace App\src\Domain\Article\Repository;


use App\Article;
use Illuminate\Database\Eloquent\Collection;

interface ArticleRepositoryInterface
{
    /**
     * @return Collection
     */
    public function articles(): Collection;

    /**
     * @param array $params
     * @param $tabCategories
     * @return bool
     */
    public function createArticle(array $params, $tabCategories): bool;

    /**
     * @param Article $articleModel
     * @param array $params
     * @return Article
     */
    public function model(Article $articleModel, array $params): Article;

    /**
     * @param string $id
     * @return Article
     */
    public function findArticleById(string $id): Article;

    /**
     * @param string $id
     * @param array $data
     * @param array $tabCategories
     * @return bool
     */
    public function updateArticle(string $id, array $data, array $tabCategories):bool;

    /**
     * @param string $id
     * @return bool
     */
    public function destroyArticle(string $id): bool;

}

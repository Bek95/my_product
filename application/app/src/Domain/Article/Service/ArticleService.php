<?php


namespace App\src\Domain\Article\Service;


use App\Article;
use App\src\Infrastructure\Article\Repository\ArticleRepository;

class ArticleService
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * ArticleService constructor.
     *
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function articles()
    {
        return $this->articleRepository->articles();
    }

    /**
     * @param array $params
     * @param array $tabCategories
     * @return bool
     * @throws \App\Exceptions\Article\ArticleNotCreatedException
     */
    public function createArticle(array $params, array $tabCategories): bool
    {
        return $this->articleRepository->createArticle($params, $tabCategories);
    }

    /**
     * @param $id
     * @return \App\Article
     */
    public function findArticleById(string $id): Article
    {
        return $this->articleRepository->findArticleById($id);
    }

    /**
     * @param string $id
     * @param array $data
     * @param array $tabCategories
     * @return bool
     * @throws \App\Exceptions\Article\ArticleNotFoundException
     */
    public function updateArticle(string $id, array $data, array $tabCategories)
    {
        return $this->articleRepository->updateArticle($id, $data, $tabCategories);
    }

    /**
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function destroyArticle(string $id): bool
    {
        return $this->articleRepository->destroyArticle($id);
    }

}

<?php


namespace App\src\Domain\Article\Service;


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
     * to display all articles
     *
     * @return \App\Article[]|\Illuminate\Database\Eloquent\Collection
     */
    public function articles()
    {
        return $this->articleRepository->articles();
    }

    /**
     * @param array $params
     * @return bool
     */
    public function createArticle(array $params, $tabCategories): bool
    {
        return $this->articleRepository->createArticle($params, $tabCategories);
    }

}

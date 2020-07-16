<?php


namespace App\src\Infrastructure\Article\Repository;

use App\Article;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class ArticleRepository
{
    /**
     * @var Article
     */
    private $articleModel;

    /**
     * ArticleRepository constructor.
     * @param Article $articleModel
     */
    public function __construct(Article $articleModel)
    {
        $this->articleModel = $articleModel;
        $this->article = new Article();
    }

    /**
     * to display all articles
     *
     * @return Collection
     */
    public function articles(): Collection
    {
        return $this->articleModel->all();
    }

    /**
     * @param array $params
     * @return bool
     */
    public function createArticle(array $params, $tabCategories): bool
    {
        $article = $this->model($this->article, $params);
        $res = $article->save();

        $categoriesId = [];

        foreach ($tabCategories as $categoryId => $categoryName) {
            $categoriesId[] = $categoryId;
        }
        //Ici j'attache article_id à la ou les category_id dans la table pivot
        $article->categories()->attach($categoriesId);

        return $res;
    }

    /**
     * @param Article $articleModel
     * @param $params
     * @return Article
     */
    public function model(Article $articleModel, array $params): Article
    {
        foreach ($params as $key_model => $value) {
            $articleModel->$key_model = $value;
        }

        return $articleModel;
    }

    /**
     * @param string $id
     * @return Article
     */
    public function findArticleById(string $id): Article
    {
        return $this->articleModel->find($id);
    }

    /**
     * @param string $id
     * @param array $data
     * @param array $tabCategories
     * @return bool
     */
    public function updateArticle(string $id, array $data, array $tabCategories):bool
    {
        $article = $this->findArticleById($id);
        $article->categories()->detach();
        $this->model($article, $data);

        $categoriesId = [];
        foreach ($tabCategories as $categoryId => $categoryName) {
            $categoriesId[] = $categoryId;
        }
        //Ici j'attache article_id à la ou les category_id dans la table pivot
        $article->categories()->attach($categoriesId);

        return $article->save();
    }

    /**
     * @param string $id
     * @return bool
     * @throws \Exception
     */
    public function destroyArticle(string $id): bool
    {
        $article = $this->findArticleById($id);
        $fileToDelete = '/public/articles/' . $article->image;

        if (Storage::exists($fileToDelete)) {
            Storage::delete($fileToDelete);
        }

        return $article->delete();
    }

}

<?php


namespace App\src\Infrastructure\Article\Repository;

use App\Article;
use App\Exceptions\Article\ArticleNotCreatedException;
use App\Exceptions\Article\ArticleNotFoundException;
use App\src\Domain\Article\Repository\ArticleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ArticleRepository implements ArticleRepositoryInterface
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
     * @param $tabCategories
     * @return bool
     * @throws ArticleNotCreatedException
     */
    public function createArticle(array $params, $tabCategories): bool
    {
        try {
            $article = $this->model($this->article, $params);
            Log::info('This ' . $article . ' WAS CREATED WITH THIS PARAMS : ' . json_encode($params) . ' AND AFFILIATED CATEGORIES' . json_encode($tabCategories) );
            $res = $article->save();

            $categoriesId = [];

            foreach ($tabCategories as $categoryId => $categoryName) {
                $categoriesId[] = $categoryId;
            }
            //Ici j'attache article_id à la ou les category_id dans la table pivot
            $article->categories()->attach($categoriesId);

            return $res;

        }catch (\Exception $exception) {
            throw new ArticleNotCreatedException('THIS ARTICLE WAS NOT CREATED WITH PARAMS ' . json_encode($params) . ' AND AFFILIATED CATEGORIES : ' . json_encode($tabCategories));
        }
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
     * @throws ArticleNotFoundException
     */
    public function updateArticle(string $id, array $data, array $tabCategories):bool
    {
        try {
            $article = $this->findArticleById($id);
            $article->categories()->detach();
            $this->model($article, $data);
            Log::info('THE ARTICLE : ' . $article . ' WAS UPDATED');

            $categoriesId = [];
            foreach ($tabCategories as $categoryId => $categoryName) {
                $categoriesId[] = $categoryId;
            }
            //Ici j'attache article_id à la ou les category_id dans la table pivot
            $article->categories()->attach($categoriesId);

            return $article->save();
        }catch (\Exception $exception) {
            throw new ArticleNotFoundException('THIS ARTICLE : ' . $id . ' NOT FOUND !');
        }
    }

    /**
     * @param string $id
     * @return bool
     * @throws ArticleNotFoundException
     */
    public function destroyArticle(string $id): bool
    {
        try {
            $article = $this->findArticleById($id);
            $fileToDelete = '/public/articles/' . $article->image;
            Log::info($article);
            Log::info($fileToDelete);
            $res = $article->delete();
            Log::info($res);
            Log::info('THE ARTICLE : ' . $article . ' WAS DELETED');

            if (Storage::exists($fileToDelete)) {
                Storage::delete($fileToDelete);
            }

            return $res;

        }catch (\Exception $exception){
            throw new ArticleNotFoundException('THIS ARTICLE : ' . $id . ' NOT FOUND !');
        }
    }

}

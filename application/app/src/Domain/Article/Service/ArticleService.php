<?php


namespace App\src\Domain\Article\Service;


use App\Article;
use App\src\Domain\Utilities\ImageManager;
use App\src\Infrastructure\Article\Repository\ArticleRepository;
use Illuminate\Http\UploadedFile;
use phpDocumentor\Reflection\Types\Object_;

class ArticleService
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * @var ImageManager
     */
    private $imageManager;

    /**
     * ArticleService constructor.
     *
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository, ImageManager $imageManager)
    {
        $this->articleRepository = $articleRepository;
        $this->imageManager = $imageManager;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function articles()
    {
        return $this->articleRepository->articles();
    }

    /**
     * @param array $data
     * @param UploadedFile $image
     * @return bool
     * @throws \App\Exceptions\Article\ArticleNotCreatedException
     */
    public function createArticle(array $data, UploadedFile $image): bool
    {
        $tabCategories = $data['checkboxCategories'];
        $file = $this->imageManager->imageStorage($image);

        $params = [
            'name' => $data['name'],
            'color' => $data['color'],
            'size' => $data['size'],
            'price' => $data['price'],
            'description' => $data['description'],
            'image' => $file, // ici j'attribue le nom de l'image à mon article
        ];

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

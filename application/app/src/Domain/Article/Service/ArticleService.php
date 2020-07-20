<?php


namespace App\src\Domain\Article\Service;


use App\Article;
use App\src\Domain\Article\Repository\ArticleRepositoryInterface;
use App\src\Domain\Utilities\ImageManager;
use Illuminate\Http\UploadedFile;

class ArticleService
{
    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

    /**
     * @var ImageManager
     */
    private $imageManager;

    /**
     * ArticleService constructor.
     * @param ArticleRepositoryInterface $articleRepository
     * @param ImageManager $imageManager
     */
    public function __construct(ArticleRepositoryInterface $articleRepository, ImageManager $imageManager)
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
     * @param UploadedFile|null $image
     * @return bool
     */
    public function updateArticle(string $id, array $data, ? UploadedFile $image): bool
    {
       $tabCategories = $data['checkboxCategories'];

       if (is_null($image)) {

           $params = [
               'name' => $data['name'],
               'color' => $data['color'],
               'size' => $data['size'],
               'price' => $data['price'],
               'description' => $data['description'],
           ];
       }else{
           //ici si une image a été transmit lors de l'update, je l'affecte à l'article
           $file = $this->imageManager->imageStorage($image);

           $params = [
               'name' => $data['name'],
               'color' => $data['color'],
               'size' => $data['size'],
               'price' => $data['price'],
               'description' => $data['description'],
               'image' => $file,
           ];
       }

        return $this->articleRepository->updateArticle($id, $params, $tabCategories);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function destroyArticle(string $id): bool
    {
        return $this->articleRepository->destroyArticle($id);
    }

}

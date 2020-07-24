<?php


namespace App\Exceptions\Article;


class ArticleNotFoundException extends \Exception
{

    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }

}

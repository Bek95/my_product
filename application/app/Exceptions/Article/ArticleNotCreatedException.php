<?php


namespace App\Exceptions\Article;


use Throwable;

class ArticleNotCreatedException extends \Exception
{
    public function __construct($message = "")
    {
        parent::__construct($message);
    }

}

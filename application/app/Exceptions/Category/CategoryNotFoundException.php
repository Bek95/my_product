<?php


namespace App\Exceptions\Category;


use Throwable;

class CategoryNotFoundException extends \Exception
{
    public function __construct($message = "")
    {
        parent::__construct($message);
    }

}

<?php


namespace App\Exceptions\Category;


use Throwable;

class CategoryNotCreatedException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}

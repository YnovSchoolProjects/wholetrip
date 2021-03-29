<?php


namespace App\Exception;


class NullMimeTypeException extends \Exception
{
    public function __construct()
    {
        parent::__construct();
    }
}

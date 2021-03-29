<?php


namespace App\Exception;


class UnsupportedMimeTypeException extends \Exception
{
    public function __construct()
    {
        parent::__construct();
    }
}

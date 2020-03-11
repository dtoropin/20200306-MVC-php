<?php

namespace Base;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Error404 extends \Exception
{
    public static function Error()
    {
        $loader = new FilesystemLoader('template');
        $twig = new Environment($loader);

        echo $twig->render('404.twig');
        exit;
    }
}
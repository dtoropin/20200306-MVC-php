<?php

namespace App\View;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Index_View
{
    private $_twig;

    public function __construct()
    {
        $loader = new FilesystemLoader('template');
        $this->_twig = new Environment($loader);
    }

    public function render()
    {
        $template = 'start.twig';
        echo $this->_twig->render($template);
    }
}
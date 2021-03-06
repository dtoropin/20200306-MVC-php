<?php

namespace App\View;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class User_View
{
    private $_twig;

    public function __construct()
    {
        $loader = new FilesystemLoader('template');
        $this->_twig = new Environment($loader);
    }

    public function render($template, $data)
    {
        switch ($template) {
            case 'login':
                $template = 'login.twig';
                break;
            case 'register':
                $template = 'register.twig';
                break;
            default:
                $template = 'users.twig';
        }
        echo $this->_twig->render($template, $data);
    }
}
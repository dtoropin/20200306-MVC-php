<?php

namespace App\View;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Admin_View
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
            case 'edit':
                $template = 'edit.twig';
                break;
            case 'create':
                $template = 'register.twig';
                break;
            default:
                $template = 'admin.twig';
        }
        echo $this->_twig->render($template, $data);
    }
}
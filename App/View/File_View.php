<?php

namespace App\View;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class File_View
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
            case 'user':
                $template = 'userFile.twig';
                break;
            case 'add':
                $template = 'add.twig';
                break;
            default:
                $template = 'files.twig';
        }
        echo $this->_twig->render($template, $data);
    }
}
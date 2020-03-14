<?php

namespace App\Controller;

use App\View\Index_View;

class Index_Controller
{
    private $_view;

    public function __construct()
    {
        $this->_view = new Index_View();
    }

    public function index()
    {
        $this->_view->render('index');
    }
}
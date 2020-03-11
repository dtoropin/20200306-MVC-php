<?php

namespace App\Controller;

use App\Model\User_Model;
use App\View\User_View;

class User_Controller
{
    private $_view;
    private $_data;

    public function __construct()
    {
        $this->_view = new User_View();
        $this->_data = new User_Model();
    }

    public function index()
    {
        $data = $this->_data->index();
        $this->_view->render('index', $data);
    }

    public function login()
    {
        $data = $this->_data->login();
        $this->_view->render('login', $data);
    }

    public function register()
    {
        $data = $this->_data->register();
        $this->_view->render('register', $data);
    }
}
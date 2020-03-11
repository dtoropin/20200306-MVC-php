<?php

namespace App\Controller;

use App\Model\File_Model;
use App\View\File_View;

class File_Controller
{
    private $_view;
    private $_data;

    public function __construct()
    {
        $this->_view = new File_View();
        $this->_data = new File_Model();
    }

    public function index()
    {
        $data = $this->_data->index();
        $this->_view->render('index', $data);
    }

    public function user($id)
    {
        $data = $this->_data->user($id);
        $this->_view->render('user', $data);
    }

    public function add($id)
    {
        $data = $this->_data->add($id);
        $this->_view->render('add', $data);
    }
}
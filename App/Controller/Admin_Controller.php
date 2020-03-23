<?php

namespace App\Controller;


use App\Model\User_Model as User;
use App\View\Admin_View;
use Intervention\Image\ImageManagerStatic as Image;

class Admin_Controller
{
    private $_view;
    private $_data;

    public function __construct()
    {
        $this->_view = new Admin_View();
        $this->_data = new User();
    }

    public function index()
    {
        $data = $this->_data::query()->get();
        $this->_view->render('admin', ['context' => $data]);
    }

    public function delete($id)
    {
        $this->_data::destroy($id);
        header('Location: /admin');
        exit;
    }

    public function edit($id)
    {
        $data = $this->_data::query()->where('id', $id)->first();

        if (!$_POST) {
            $this->_view->render('edit', ['user' => $data]);
            exit;
        }

        $user = User::find($id);
        $user->name = htmlentities(trim($_POST['name']));
        $user->age = htmlentities(trim($_POST['age']));
        $user->desc = htmlentities(trim($_POST['desc']));
        $user->email = htmlentities(trim($_POST['email']));
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $img = Image::make($fileTmpPath);
            $img->save('./images/avatars/' . $fileName);
            $avatar = $fileName;
        }
        $user->avatar = $avatar ?: $data['avatar'];
        $user->save();

        header('Location: /admin');
        exit;
    }

    public function create()
    {
        if (!$_POST) {
            $this->_view->render('create', ['context' => 'Create user']);
            exit;
        }
        $name = htmlentities(trim($_POST['name']));
        $age = htmlentities(trim((int)$_POST['age']));
        $email = htmlentities(trim($_POST['email']));
        $desc = htmlentities(trim($_POST['desc']));
        $pass = password_hash(htmlentities(trim($_POST['pass'])) . $this->_salt, PASSWORD_DEFAULT);
        $avatar = 'user.png';

        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $img = Image::make($fileTmpPath);
            $img->save('./images/avatars/' . $fileName);
            $avatar = $fileName;
        }

        User::create([
            'name' => $name,
            'age' => $age,
            'desc' => $desc,
            'email' => $email,
            'avatar' => $avatar,
            'password' => $pass
        ]);

        header('Location:/admin');
        exit;
    }
}
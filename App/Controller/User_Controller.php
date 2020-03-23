<?php

namespace App\Controller;

use App\Model\User_Model as User;
use App\View\User_View;
use Intervention\Image\ImageManagerStatic as Image;

class User_Controller
{
    private $_view;
    private $_data;
    private $_salt = 'sajnl70&7076^%#SDO';

    public function __construct()
    {
        $this->_view = new User_View();
        $this->_data = new User();
    }

    public function index()
    {
        if (!isset($_COOKIE['sort']) || $_COOKIE['sort'] === 'ASC') {
            $data = $this->_data::query()->orderBy('age', 'ASC')->get();
        } else {
            $data = $this->_data::query()->orderBy('age', 'DESC')->get();
        }
        $this->_view->render('users', ['context' => $data]);
    }

    public function login()
    {
        if (!$_POST) {
            $this->_view->render('login', ['context' => 'Login!']);
            exit;
        }

        $name = htmlentities(trim($_POST['name']));
        $pass = htmlentities(trim($_POST['pass'])) . $this->_salt;
        $user = User::query()->where('name', $name)->first();
        if (password_verify($pass, $user->password)) {
            $_SESSION['user'] = 'user-' . $user->id;
            header('Location:/file/user/' . $user->id);
            exit;
        }
    }

    public function register()
    {
        if (!$_POST) {
            $this->_view->render('register', ['context' => 'Register!']);
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

        header('Location:/');
        exit;
    }
}
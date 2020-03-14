<?php

namespace App\Model;

use Intervention\Image\ImageManagerStatic as Image;

class User_Model
{
    public function index()
    {
        if (!isset($_COOKIE['sort']) || $_COOKIE['sort'] == 'ASC') {
            $person = \ORM::for_table('users')->order_by_asc('age')->find_many();
        } else {
            $person = \ORM::for_table('users')->order_by_desc('age')->find_many();
        }
        return ['context' => $person];
    }

    public function login()
    {
        if (!$_POST) {
            return ['context' => 'Login!'];
        }

        $name = htmlentities(trim($_POST['name']));
        $pass = htmlentities(trim($_POST['pass'])) . SALT;
        $user = \ORM::forTable('users')->where('name', $name)->find_one();
        if (password_verify($pass, $user->password)) {
            $_SESSION['user'] = 'user-' . $user->id;
            header('Location:/file/user/' . $user->id);
            exit;
        }

        header('Location:/');
        exit;
    }

    public function register()
    {
        if (!$_POST) {
            return ['context' => 'Register!'];
        }

        $name = htmlentities(trim($_POST['name']));
        $age = htmlentities(trim((int)$_POST['age']));
        $desc = htmlentities(trim($_POST['desc']));
        $pass = password_hash(htmlentities(trim($_POST['pass'])) . SALT, PASSWORD_DEFAULT);
        $avatar = 'user.png';

        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $img = Image::make($fileTmpPath);
            $img->save('./images/avatars/' . $fileName);
            $avatar = $fileName;
        }

        $person = \ORM::for_table('users')->create();
        $person->name = $name;
        $person->age = $age;
        $person->desc = $desc;
        $person->avatar = $avatar;
        $person->password = $pass;
        $person->save();

        header('Location:/');
        exit;
    }
}
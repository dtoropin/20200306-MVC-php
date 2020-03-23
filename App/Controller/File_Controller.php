<?php

namespace App\Controller;

use App\Model\File_Model as File;
use App\Model\User_Model;
use App\View\File_View;
use Intervention\Image\Constraint;
use Intervention\Image\ImageManagerStatic as Image;

class File_Controller
{
    private $_view;
    private $_data;

    public function __construct()
    {
        $this->_view = new File_View();
        $this->_data = new File();
    }

    public function index()
    {
        $data = $this->_data::all();
        $this->_view->render('index', ['context' => $data]);
    }

    public function user($id)
    {
        $auth = false;
        $user = User_Model::query()->where('id', $id)->first();
        $data = $this->_data::with('user')->where('user_id', $id)->get();
        if ($_SESSION['user'] === 'user-' . $id) {
            $auth = true;
        }
        $this->_view->render('user', ['context' => $data, 'user' => $user, 'auth' => $auth]);
    }

    public function add($id)
    {
        if (isset($_FILES['file'])) {
            for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
                if ($_FILES['file']['error'][$i]) {
                    echo 'error';
                    break;
                }
                $fileTmpPath = $_FILES['file']['tmp_name'][$i];
                $fileName = $_FILES['file']['name'][$i];
                $img = Image::make($fileTmpPath);
                $img->resize(350, null, function (Constraint $constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $img->save('./images/files/' . $fileName);

                File::create([
                    'file_name' => $fileName,
                    'user_id' => $id
                ]);
            }

            header('Location:/file/user/' . $id);
            exit;
        }
        $this->_view->render('add', ['context' => 'add files']);
    }
}
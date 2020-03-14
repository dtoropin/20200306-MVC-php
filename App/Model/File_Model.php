<?php

namespace App\Model;

use Intervention\Image\Constraint;
use Intervention\Image\ImageManagerStatic as Image;

class File_Model
{
    public function index()
    {
        $files = \ORM::for_table('files')->find_many();
        return ['context' => $files];
    }

    public function user($id)
    {
        $auth = false;
        $files = \ORM::for_table('files')->where('user_id', $id)->find_many();
        $user = \ORM::for_table('users')->where('id', $id)->find_one();
        if ($_SESSION['user'] === 'user-' . $user->id) {
            $auth = true;
        }
        return ['context' => $files, 'user' => $user, 'auth' => $auth];
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
                $file = \ORM::for_table('files')->create();
                $file->file_name = $fileName;
                $file->user_id = $id;
                $name = \ORM::for_table('users')->select('name')->where('id', $id)->find_one();
                $file->user_name = $name['name'];
                $file->save();
            }

            header('Location:/file/user/' . $id);
            exit;
        } else {
            return ['context' => 'add files'];
        }
    }
}
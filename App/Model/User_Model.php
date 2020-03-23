<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User_Model extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'age', 'desc', 'email', 'avatar', 'password'];

    public function files()
    {
        return $this->hasMany(File_Model::class, 'user_id', 'id');
    }
}
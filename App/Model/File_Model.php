<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class File_Model extends Model
{
    protected $table = 'files';
    protected $fillable = ['file_name', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User_Model::class, 'user_id', 'id');
    }
}
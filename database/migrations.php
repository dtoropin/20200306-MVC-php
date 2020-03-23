<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Model\User_Model as User;
use App\Model\File_Model as File;

if (!Capsule::schema()->hasTable('users')) {
    //Capsule::schema()->dropIfExists('users');
    Capsule::schema()->create('users', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name'); //varchar 255
        $table->integer('age')->default(18);
        $table->text('desc')->nullable();
        $table->string('email'); //varchar 255
        $table->string('avatar')->default('user.png'); //varchar 255
        $table->string('password'); //varchar 255
        $table->timestamps(); //created_at&updated_at тип datetime
    });

    // add users
    $user = new User([
        'name' => 'Denis',
        'age' => 46,
        'desc' => 'Developer',
        'email' => 'example@mail.ru',
        'avatar' => 'IMG_0795.JPG',
        'password' => '$2y$10$48NxLAR6kF1qFaUsfwn/muE0/r.bbMPbizbO/JLSkLzurapw5YYQK' // admin
    ]);
    $user->save();

    $user = new User([
        'name' => 'Misha',
        'age' => 17,
        'desc' => 'Looser',
        'email' => 'loozer@mail.com',
        'password' => '$2y$10$MglTv9d5lwiR7UGlHRrQMuBrIxyIwnMT6kpPnufaFYROM7nsWSy3e' // asdasd
    ]);
    $user->save();
}

if (!Capsule::schema()->hasTable('files')) {
    //Capsule::schema()->dropIfExists('files');
    Capsule::schema()->create('files', function (Blueprint $table) {
        $table->increments('file_id');
        $table->string('file_name'); //varchar 255
        $table->integer('user_id')->unsigned();;
        $table->timestamps(); //created_at&updated_at тип datetime
    });

    // add files
    $file = new File([
        'file_name' => 'abk9yxOfJ90.jpg',
        'user_id' => 1
    ]);
    $file->save();

    $file = new File([
        'file_name' => 'c8ZgP3ZDGvY.jpg',
        'user_id' => 1
    ]);
    $file->save();

    $file = new File([
        'file_name' => 'GoOCWBNqwTI.jpg',
        'user_id' => 2
    ]);
    $file->save();
}
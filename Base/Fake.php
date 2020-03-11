<?php

namespace Base;

use Faker\Factory;

class Fake
{
    public static function fakeData()
    {
        $count = \ORM::for_table('users')->count();
        if ($count != 1) {
            return false;
        }

        for ($i = 0; $i < 10; $i++) {
            $faker = Factory::create('ru_RU');
            $name = $faker->firstName;
            $age = $faker->numberBetween($min = 10, $max = 70);
            $desc = $faker->text($maxNbChars = 90);
            $avatar = 'user.png';
            $pass = $faker->text($maxNbChars = 10);

            $person = \ORM::for_table('users')->create();
            $person->name = $name;
            $person->age = $age;
            $person->desc = $desc;
            $person->avatar = $avatar;
            $person->password = $pass;
            $person->save();
        }
    }
}
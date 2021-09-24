<?php

use Faker\Generator as Faker;
use App\Models\EnqueteManagement;

$factory->define(EnqueteManagement::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'sex' => $faker->randomElement(['1','2']),
        'age' => $faker->randomElement(['10','20','30','40','50','60']),
        'mail' => $faker->email,
        'send_mail' => $faker->randomElement(['0','1']),
        'comment' => $faker->text(400),
    ];
});

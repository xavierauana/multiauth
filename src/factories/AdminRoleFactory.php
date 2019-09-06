<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Anacreation\MultiAuth\Model\AdminRole;
use Faker\Generator as Faker;

$factory->define(AdminRole::class, function (Faker $faker) {
    return [
        'code'  => $faker->word,
        'label' => $faker->word,
    ];
});

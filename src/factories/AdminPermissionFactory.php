<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Anacreation\MultiAuth\Model\AdminPermission;
use Faker\Generator as Faker;

$factory->define(AdminPermission::class, function (Faker $faker) {
    return [
        'code'  => $faker->word,
        'label' => $faker->word,
    ];
});

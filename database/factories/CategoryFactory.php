<?php

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->realText(random_int(10, 15)),
        'banner' => $faker->imageUrl(),
    ];
});

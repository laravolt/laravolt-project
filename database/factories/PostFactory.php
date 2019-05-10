<?php

use Faker\Generator as Faker;

$factory->define(\Modules\Post\Models\Post::class, function (Faker $faker) {
    return [
        'title'     => $faker->sentence,
        'content'   => $faker->paragraphs(3, true),
        'author_id' => 1,
    ];
});

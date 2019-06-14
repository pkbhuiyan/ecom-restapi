<?php

use Faker\Generator as Faker;


$factory->define(App\Model\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'detail' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'price' => $faker->numberBetween($min = 10, $max = 999),
        'stock' => $faker->randomDigit,
        'discount' => $faker->numberBetween($min = 4, $max = 10),
        'user_id' => function(){
            return App\User::all()->random();
        },
        
    ];
});

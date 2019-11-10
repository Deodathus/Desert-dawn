<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Models\Quest\Mission::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'quest_id' => 1,
        'description' => Str::random(15),
        'energy_cost' => rand(1, 10),
        'reward_gold' => rand(100, 500),
        'reward_exp' => rand(100, 200),
        'reward_gems' => rand(10, 50),
        'reward_item' => 1,
        'reward_item_rarity' => 1,
        'done' => false,
    ];
});

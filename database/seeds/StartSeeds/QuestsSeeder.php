<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quests')->insert([
            'name' => Str::random(10),
            'description' => Str::random(20),
            'reward_gold' => rand(10, 100),
            'reward_gems' => rand(10, 100),
            'reward_exp' => rand(10, 100),
            'reward_item_rarity' => 1,
            'reward_item' => 1,
            'done' => false,
        ]);
    }
}

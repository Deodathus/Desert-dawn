<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BossesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bosses')->insert([
            'name' => Str::random(10),
            'hp' => rand(100, 1000),
            'armor' => rand(1, 10),
            'reward_gold' => rand(10, 100),
            'reward_gems' => rand(10, 100),
            'reward_exp' => rand(100, 200),
            'reward_item_rarity' => 1,
        ]);
    }
}

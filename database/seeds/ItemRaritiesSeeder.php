<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ItemRaritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_rarities')->insert([
            'name' => Str::random(10),
            'min_stat_multiply' => rand(1, 100),
            'max_stat_multiply' => rand(100, 200),
            'skill_amount' => rand(1, 10),
            'price' => rand(1, 10000),
        ]);
    }
}

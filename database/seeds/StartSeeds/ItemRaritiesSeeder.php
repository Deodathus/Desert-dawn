<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'name' => 'Common',
            'min_stat_multiply' => rand(1, 100),
            'max_stat_multiply' => rand(100, 200),
            'skill_amount' => rand(1, 10),
            'price' => rand(1, 10000),
        ]);
    }
}

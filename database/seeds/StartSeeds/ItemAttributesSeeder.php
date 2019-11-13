<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemAttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('item_attributes')->insert([
            'item_id' => 1,
            'strength' => rand(1, 100),
            'stamina' => rand(1, 100),
            'agility' => rand(1, 100),
            'intellect' => rand(1, 100),
            'luck' => rand(1, 100),
            'wisdom' => rand(1, 100),
        ]);
    }
}

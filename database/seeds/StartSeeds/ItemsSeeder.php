<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            'item_rarity_id' => 1,
            'name' => Str::random(10),
            'required_level' => 1,
            'type' => 1,
        ]);
    }
}

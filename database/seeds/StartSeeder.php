<?php

use Illuminate\Database\Seeder;

class StartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            ItemRaritiesSeeder::class,
            ItemTypesSeeder::class,
            ItemsSeeder::class,
            ItemAttributesSeeder::class,
            BossesSeeder::class,
            QuestsSeeder::class,
            MissionsSeeder::class,
        ]);
    }
}

<?php

use App\Models\Quest\Mission;
use Illuminate\Database\Seeder;

class MissionsSeeder extends Seeder
{
    /**
     * Run database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Mission::class, 5)->create();
    }
}

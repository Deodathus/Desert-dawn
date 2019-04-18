<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBossesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bosses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('hp');
            $table->integer('armor');
            $table->integer('reward_gold');
            $table->integer('reward_exp');
            $table->integer('reward_item');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bosses');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('quest_id');
            $table->text('description');
            $table->integer('energy_cost');
            $table->integer('reward_gold');
            $table->integer('reward_exp');
            $table->integer('reward_gems');
            $table->bigInteger('reward_item')->default(null)->nullable();
            $table->bigInteger('reward_item_rarity')->default(null)->nullable();
            $table->boolean('done')->default(false);
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
        Schema::dropIfExists('missions');
    }
}

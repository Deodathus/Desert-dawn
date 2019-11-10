<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(false);
            $table->integer('coins')->default(500);
            $table->integer('gems')->default(10);
            $table->integer('energy')->default(5);
            $table->integer('level')->default(1);
            $table->integer('exp')->default(0);
            $table->integer('skill_1')->default(5);
            $table->integer('skill_2')->default(1);
            $table->integer('skill_3')->default(0);
            $table->integer('skill_1_damage')->default(100);
            $table->integer('skill_2_damage')->default(500);
            $table->integer('skill_3_damage')->default(1000);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

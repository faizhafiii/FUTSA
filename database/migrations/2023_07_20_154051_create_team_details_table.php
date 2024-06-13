<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('squad');
            $table->integer('win');
            $table->integer('draw');
            $table->integer('lose');
            $table->integer('goalfor');
            $table->integer('goalagainst');
            $table->string('status');
            $table->foreignId('owner_id')->constrained('user_details');
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
        Schema::dropIfExists('team_details');
    }
};

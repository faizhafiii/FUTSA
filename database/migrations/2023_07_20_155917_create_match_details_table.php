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
        Schema::create('match_details', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('hometeam');
            $table->string('awayteam');
            $table->integer('homescore');
            $table->integer('awayscore');
            $table->integer('homeyellowcard');
            $table->integer('homeredcard');
            $table->integer('awayyellowcard');
            $table->integer('awayredcard');
            $table->string('referee');
            $table->string('homescorer');
            $table->string('awayscorer');
            $table->dateTime('datetime');
            $table->string('status');
            $table->string('location');
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
        Schema::dropIfExists('match_details');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameInstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_instances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('white_player')->nullable();
            $table->foreignId('black_player')->nullable();
            $table->text('board')->nullable();
            $table->text('pieces')->nullable();
            $table->string('player_turn')->default('white');
            $table->boolean('white_in_check')->default(false);
            $table->boolean('black_in_check')->default(false);
            $table->string('instanceToken');
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
        Schema::dropIfExists('game_instances');
    }
}

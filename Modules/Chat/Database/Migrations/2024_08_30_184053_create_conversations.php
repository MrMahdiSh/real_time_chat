<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('converstations', function (Blueprint $table) {
            $table->id();
            $table->enum('target', ['channels', 'groups', 'private']);
            $table->unsignedBigInteger('from');
            $table->unsignedBigInteger('to');
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
        Schema::dropIfExists('converstations');
    }
}

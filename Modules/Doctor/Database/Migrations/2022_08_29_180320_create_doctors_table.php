<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('family')->nullable();
            $table->text('username')->nullable();
            $table->text('email')->nullable();
            $table->text('mobile')->nullable();
            $table->text('password')->nullable();
            $table->text('about_me')->nullable();
            $table->text('gender')->nullable();
            $table->text('birth_day')->nullable();
            $table->text('specialist')->nullable();
            $table->text('services')->nullable();
            $table->integer('clinic_id')->nullable();
            $table->integer('complete_account')->nullable();

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
        Schema::dropIfExists('doctors');
    }
}

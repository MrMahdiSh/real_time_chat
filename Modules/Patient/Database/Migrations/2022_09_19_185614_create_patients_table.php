<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('family')->nullable();
            $table->text('birth_day')->nullable();
            $table->date('period_at')->nullable();
            $table->integer('period_days')->nullable();
            $table->text('blood')->nullable();
            $table->text('mobile')->nullable();
            $table->text('national_code')->nullable();
            $table->text('password')->nullable();
            $table->text('state_id')->nullable();
            $table->text('city_id')->nullable();
            $table->text('address')->nullable();

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
        Schema::dropIfExists('patients');
    }
}

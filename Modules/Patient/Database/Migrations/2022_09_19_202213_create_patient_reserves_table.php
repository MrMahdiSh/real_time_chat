<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_reserves', function (Blueprint $table) {
            $table->id();
            $table->integer('doc_id')->nullable();
            $table->integer('patient_id')->nullable();
            $table->text('price')->nullable();
            $table->text('time')->nullable();
            $table->text('date')->nullable();
            $table->text('number')->nullable();
            $table->text('status')->nullable();
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
        Schema::dropIfExists('patient_reserves');
    }
}

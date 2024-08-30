<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_reserves', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id');
            $table->integer('service_id');
            $table->text('date');
            $table->text('price');
            $table->text('time');
            $table->enum('status', [\App\OrderStatus::Unpaid, \App\OrderStatus::Paid])->default(\App\OrderStatus::Unpaid);
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
        Schema::dropIfExists('service_reserves');
    }
}

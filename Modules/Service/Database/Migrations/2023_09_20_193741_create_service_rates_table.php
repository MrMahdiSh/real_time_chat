<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_rates', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id');
            $table->integer('service_id');
            $table->text('message');
            $table->text('star');
            $table->enum('suggest', [\App\Status::False, \App\Status::True]);
            $table->enum('status', [\App\Status::True, \App\Status::False])->default(\App\Status::False);
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
        Schema::dropIfExists('service_rates');
    }
}

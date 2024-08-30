<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesModelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_model', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_id');
            $table->integer('category_id');
            $table->text('title');
            $table->bigInteger('price');
            $table->integer('offer');
            $table->text('description');
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
        Schema::dropIfExists('services_model');
    }
}

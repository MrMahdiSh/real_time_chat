<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocorScheduleTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docor_schedule_times', function (Blueprint $table) {
            $table->id();
            $table->integer('doc_id')->nullable();
            $table->text('week')->nullable();
            $table->text('begin_time')->nullable();
            $table->text('end_time')->nullable();
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
        Schema::dropIfExists('docor_schedule_times');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificatePharmaciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate_pharmacies', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_id');
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
        Schema::dropIfExists('certificate_pharmacies');
    }
}

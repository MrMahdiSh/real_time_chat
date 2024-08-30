<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('doctor_id')->nullable();
            $table->text('number')->nullable();
            $table->text('title')->nullable();
            $table->text('offer')->nullable();
            $table->text('price')->nullable();
            $table->text('category_id')->nullable();
            $table->text('brand_id')->nullable();
            $table->text('count')->nullable();
            $table->text('country')->nullable();
            $table->text('size')->nullable();
            $table->text('description')->nullable();
            $table->text('how_to_use')->nullable();
            $table->text('keeping')->nullable();
            $table->text('instruction')->nullable();
            $table->text('warning')->nullable();
            $table->enum('status', [\App\Status::False, \App\Status::True])->default(\App\Status::False);

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
        Schema::dropIfExists('products');
    }
}

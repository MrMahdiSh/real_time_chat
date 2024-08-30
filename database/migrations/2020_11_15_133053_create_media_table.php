<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->text('file_name')->nullable();
            $table->text('extension')->nullable();
            $table->text('size')->nullable();
            $table->text('media_title')->nullable();
            $table->text('media_id')->nullable();
            $table->text('description')->nullable();
            $table->text('mime')->nullable();
            $table->enum('type', ['image', 'video'])->nullable();
            $table->enum('image_type', ['file', 'base64'])->nullable();
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
        Schema::dropIfExists('media');
    }
}

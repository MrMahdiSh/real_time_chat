<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('permission')->nullable();
            $table->string('label')->nullable();
            $table->string('route')->nullable();
            $table->string('description')->nullable();
            $table->integer('parent_id')->nullable()->default(0);
            $table->integer('pp_id')->nullable()->default(0);
            $table->integer('ppp_id')->nullable()->default(0);
            $table->string('icon')->nullable();
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
        Schema::dropIfExists('menus');
    }
}

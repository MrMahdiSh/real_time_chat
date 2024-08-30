<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Advertise\Entities\BannerType;

class CreateAdvertisePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertise_pages', function (Blueprint $table) {
            $table->id();
            $table->enum('type', [BannerType::Text, BannerType::Media])->nullable();
            $table->text('title')->nullable();
            $table->text('link')->nullable();
            $table->text('route_name')->nullable();
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
        Schema::dropIfExists('advertise_pages');
    }
}

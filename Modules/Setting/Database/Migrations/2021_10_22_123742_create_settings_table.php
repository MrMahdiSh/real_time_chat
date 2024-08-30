<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('contact_us_title')->nullable();
            $table->text('contact_us')->nullable();
            $table->text('map_text')->nullable();


            $table->text('site_name')->nullable();
            $table->text('footer_text')->nullable();


            $table->text('site_color')->nullable();


            $table->text('address')->nullable();
            $table->text('phone')->nullable();
            $table->text('email')->nullable();

            $table->text('telegram_link')->nullable();
            $table->text('insta_link')->nullable();
            $table->text('linkedin_link')->nullable();


            $table->text('privacy')->nullable();
            $table->text('policy')->nullable();

            ///////////////////////////////////

            $table->text('site_title')->nullable();
            $table->text('site_description')->nullable();

            $table->text('about_us')->nullable();


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
        Schema::dropIfExists('settings');
    }
}

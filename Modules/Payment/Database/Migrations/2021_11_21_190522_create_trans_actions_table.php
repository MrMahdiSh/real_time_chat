<?php

use App\TypeModelTransAction;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_actions', function (Blueprint $table) {
            $table->id();
            $table->text('user_id')->nullable();
            $table->text('type')->nullable();
            $table->text('number')->nullable();
            $table->text('price')->nullable();
            $table->enum('status', ["1", "0"])->nullable();
            $table->text('title')->nullable();
            $table->text('order_id')->nullable();
            $table->enum('type_model', [TypeModelTransAction::Patient, TypeModelTransAction::Doctor, TypeModelTransAction::Admin])->nullable();
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
        Schema::dropIfExists('trans_actions');
    }
}

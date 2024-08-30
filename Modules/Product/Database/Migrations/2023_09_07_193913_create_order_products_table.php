<?php

use App\OrderStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->text('doctor_id')->nullable();
            $table->text('client_id')->nullable();
            $table->text('number')->nullable();
            $table->text('price')->nullable();
            $table->text('address')->nullable();
            $table->enum('status', [OrderStatus::Paid, OrderStatus::Delivered, OrderStatus::Unpaid])->default(OrderStatus::Unpaid);
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
        Schema::dropIfExists('order_products');
    }
}

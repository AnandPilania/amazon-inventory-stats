<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('amazon_order_id')->nullable();
            $table->string('merchant_order_id')->nullable();
            $table->string('purchase_date')->nullable();
            $table->string('last_updated_date')->nullable();
            $table->string('order_status')->nullable();
            $table->string('fulfillment_channel')->nullable();
            $table->string('sales_channel')->nullable();
            $table->string('order_channel')->nullable();
            $table->string('url')->nullable();
            $table->string('ship_service_level')->nullable();
            $table->text('product_name')->nullable();
            $table->string('sku')->nullable();
            $table->string('asin')->nullable();
            $table->string('quantity');
            $table->unsignedInteger('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists('orders');
    }
}

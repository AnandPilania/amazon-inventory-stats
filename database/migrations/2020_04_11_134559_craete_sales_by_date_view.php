<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CraeteSalesByDateView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        DB::statement('CREATE OR REPLACE VIEW orders_by_date_view as
                    SELECT user_id , sku, sales_channel, DATE(purchase_date) as purchase_date, SUM(quantity) as order_total
                        FROM orders
                        GROUP BY user_id, sku, purchase_date, sales_channel
                     ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        //
        DB::statement("DROP VIEW orders_by_date_view");

    }
}

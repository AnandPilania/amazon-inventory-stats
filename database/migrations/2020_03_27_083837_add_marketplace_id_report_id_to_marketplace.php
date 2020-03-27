<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMarketplaceIdReportIdToMarketplace extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->unsignedInteger('marketplace_id')->nullable();
            $table->unsignedInteger('report_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn(['marketplace_id', 'report_id']);
        });
    }
}

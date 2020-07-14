<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegionIdColumnToMwsRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mws_report_request', function (Blueprint $table) {
            //
            $table->unsignedInteger('region_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mws_report_request', function (Blueprint $table) {
            //
            $table->dropColumn('region_id');
        });
    }
}

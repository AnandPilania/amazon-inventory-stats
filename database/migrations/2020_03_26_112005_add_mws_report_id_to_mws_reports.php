<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMwsReportIdToMwsReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::table('mws_report_request', function (Blueprint $table) {
            //
            $table->string('status')->nullable();
            $table->string('mws_report_id')->nullable();
            $table->dateTime('mws_report_fetched_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::table('mws_report_request', function (Blueprint $table) {

            $table->dropColumn(['status', 'mws_report_id', 'mws_report_fetched_at']);

        });
    }
}

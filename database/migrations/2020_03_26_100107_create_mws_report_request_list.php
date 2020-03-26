<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMwsReportRequestList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mws_report_request', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('report_type');
            $table->string('report_request_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('marketplace_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mws_report_request');
    }
}

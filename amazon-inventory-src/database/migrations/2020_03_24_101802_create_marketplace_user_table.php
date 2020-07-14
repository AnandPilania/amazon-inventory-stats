<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketplaceUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplace_user', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('marketplace_id');

            $table->string('mws_auth_token');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marketplace_user');
    }
}

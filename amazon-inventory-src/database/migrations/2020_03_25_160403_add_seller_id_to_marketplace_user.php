<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSellerIdToMarketplaceUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::table('marketplace_user', function (Blueprint $table) {
            //
            $table->string('seller_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::table('marketplace_user', function (Blueprint $table) {
            $table->dropColumn('seller_id');
        });
    }
}

<?php

use Illuminate\Database\Seeder;

class MarketplaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {

        DB::table('regions')->insert([
            'name' => 'America',
        ]);
        DB::table('regions')->insert([
            'name' => 'Europe',
        ]);

        DB::table('regions')->insert([
            'name' => 'Far East',
        ]);
//        factory(\App\Marketplace::class, 50)->create();

        $marketplaces = [
            [
                'amazon_marketplace_id' => 'A2EUQ1WTGCTBG2',
                'endpoint' => 'mws.amazonservices.ca',
                'name' => 'Canada',
                'code' => 'CA',
            ],
            [
                'amazon_marketplace_id' => 'ATVPDKIKX0DER',
                'endpoint' => 'mws.amazonservices.com',
                'name' => 'US',
                'code' => 'US',
            ],
            [
                'amazon_marketplace_id' => 'A1AM78C64UM0Y8',
                'endpoint' => 'mws.amazonservices.com.mx',
                'name' => 'Mexico',
                'code' => 'MX',
            ],

            [
                'amazon_marketplace_id' => 'A1PA6795UKMFR9',
                'endpoint' => 'mws-eu.amazonservices.com',
                'name' => 'Germany',
                'code' => 'DE',
            ],
            [
                'amazon_marketplace_id' => 'A1RKKUPIHCS9HS',
                'endpoint' => 'mws-eu.amazonservices.com',
                'name' => 'Spain',
                'code' => 'ES',
            ],
            [
                'amazon_marketplace_id' => 'A13V1IB3VIYZZH',
                'endpoint' => 'mws-eu.amazonservices.com',
                'name' => 'France',
                'code' => 'FR',
            ],
            [
                'amazon_marketplace_id' => 'A21TJRUUN4KGV',
                'endpoint' => 'mws.amazonservices.in',
                'name' => 'India',
                'code' => 'IN',
            ],
            [
                'amazon_marketplace_id' => 'APJ6JRA9NG5V4',
                'endpoint' => 'mws-eu.amazonservices.com',
                'name' => 'Italy',
                'code' => 'IT',
            ],
            [
                'amazon_marketplace_id' => 'A1F83G8C2ARO7P',
                'endpoint' => 'mws-eu.amazonservices.com',
                'name' => 'UK',
                'code' => 'GB',
            ],
            [
                'amazon_marketplace_id' => 'A2Q3Y263D00KWC',
                'endpoint' => 'mws.amazonservices.com',
                'name' => 'Brazil',
                'code' => 'BR',
            ],
//            [
//                'amazon_marketplace_id' => 'A1VC38T7YXB528',
//                'endpoint' => 'mws.amazonservices.jp',
//                'name' => 'Japan',
//                'code' => 'JP',
//
//            ],

//            [
//                'amazon_marketplace_id' => 'A39IBJ37TRP1C6',
//                'endpoint' => 'mws.amazonservices.com.au',
//                'name' => 'Australia',
//                'code' => 'AU',
//            ],


        ];

        foreach ($marketplaces as $marketplace) {

            DB::table('marketplaces')->insert($marketplace);
        }

    }
}

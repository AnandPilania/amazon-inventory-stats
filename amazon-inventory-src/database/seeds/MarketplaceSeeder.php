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
            'name' => 'US',
            'id' => 1,
        ]);
        DB::table('regions')->insert([
            'name' => 'EU',
            'id' => 2,
        ]);

        DB::table('regions')->insert([
            'name' => 'FE',
            'id' => 3,
        ]);
//        factory(\App\Marketplace::class, 50)->create();

        $marketplaces = [
            [
                'amazon_marketplace_id' => 'A2EUQ1WTGCTBG2',
                'endpoint' => 'mws.amazonservices.ca',
                'name' => 'Canada',
                'code' => 'CA',
                'region_id' => 1,
            ],
            [
                'amazon_marketplace_id' => 'ATVPDKIKX0DER',
                'endpoint' => 'mws.amazonservices.com',
                'name' => 'US',
                'code' => 'US',
                'region_id' => 1,
            ],
            [
                'amazon_marketplace_id' => 'A1AM78C64UM0Y8',
                'endpoint' => 'mws.amazonservices.com.mx',
                'name' => 'Mexico',
                'code' => 'MX',
                'region_id' => 1,
            ],
            [
                'amazon_marketplace_id' => 'A2Q3Y263D00KWC',
                'endpoint' => 'mws.amazonservices.com',
                'name' => 'Brazil',
                'code' => 'BR',
                'region_id' => 1,

            ],

            [
                'amazon_marketplace_id' => 'A1PA6795UKMFR9',
                'endpoint' => 'mws-eu.amazonservices.com',
                'name' => 'Germany',
                'code' => 'DE',
                'region_id' => 2,
            ],
            [
                'amazon_marketplace_id' => 'A1RKKUPIHCS9HS',
                'endpoint' => 'mws-eu.amazonservices.com',
                'name' => 'Spain',
                'code' => 'ES',
                'region_id' => 2,
            ],
            [
                'amazon_marketplace_id' => 'A13V1IB3VIYZZH',
                'endpoint' => 'mws-eu.amazonservices.com',
                'name' => 'France',
                'code' => 'FR',
                'region_id' => 2,
            ],
            [
                'amazon_marketplace_id' => 'A21TJRUUN4KGV',
                'endpoint' => 'mws.amazonservices.in',
                'name' => 'India',
                'code' => 'IN',
                'region_id' => 2,
            ],
            [
                'amazon_marketplace_id' => 'APJ6JRA9NG5V4',
                'endpoint' => 'mws-eu.amazonservices.com',
                'name' => 'Italy',
                'code' => 'IT',
                'region_id' => 2,
            ],
            [
                'amazon_marketplace_id' => 'A1F83G8C2ARO7P',
                'endpoint' => 'mws-eu.amazonservices.com',
                'name' => 'UK',
                'code' => 'GB',
                'region_id' => 2,
            ],



        ];

        foreach ($marketplaces as $marketplace) {

            DB::table('marketplaces')->insert($marketplace);
        }

    }
}

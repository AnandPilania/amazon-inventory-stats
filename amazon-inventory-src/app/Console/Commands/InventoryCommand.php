<?php

namespace App\Console\Commands;

use App\Inventory;
use App\Jobs\Amazon\GetReportJob;
use App\Order;
use App\Services\AmazonClient;
use App\User;
use Illuminate\Console\Command;

class InventoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inventory:pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull Inventory from Amazon';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::query()->whereHas('marketplaces')->get();
        foreach ($users as $user) {
            $marketplaces = $user->marketplaces;

            $items = Order::selectRaw('DISTINCT(sku) as sku')->pluck('sku')->toArray();

            foreach ($marketplaces as $marketplace) {
                $amazonClient = new AmazonClient($user, $marketplace->id);
                $data = $amazonClient->ListInventorySupply($items);

                $this->createInventoryRecord($data, $user);

            }
        }        //
    }

    public function createInventoryRecord( $data, $user)
    {
        foreach ($data as $datum){
            Inventory::query()
                ->create([
                    'sku' => $datum['SellerSKU'],
                    'asin' => $datum['ASIN'],
                    'in_stock_inventory_supply' => $datum['InStockSupplyQuantity'],
                    'condition' => $datum['Condition'],
                    'date' => now(),
                    'user_id' => $user->id
                ]);
        }

    }
}

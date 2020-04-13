<?php

namespace App\Jobs\Amazon;

use App\Order;
use App\OrderStat;
use App\OrderView;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateStatsTableJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct ()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle ()
    {
        $orders = Order::query()
            ->selectRaw('user_id ,DATE(purchase_date) as purchase_date, sku , sales_channel, SUM(quantity) as order_total')
            ->groupByRaw(' user_id, purchase_date, sku, sales_channel ')
            ->get();

        foreach ($orders as $order) {
            OrderStat::query()->updateOrCreate([
                'user_id' => $order->user_id,
                'sales_channel' => $order->sales_channel,
                'sku' => $order->sku,
                'purchase_date' => $order->purchase_date,
            ], $order->toArray());
        }
    }
}

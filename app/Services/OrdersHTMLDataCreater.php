<?php


namespace App\Services;


use App\Order;
use App\OrderStat;
use App\OrderView;
use Illuminate\Http\Request;

class OrdersHTMLDataCreater
{
    public static function ordersData (Request $request)
    {
        if (!$request->start_date || !$request->end_date) {

            $startDate = now()->subMonth()->format('Y-m-d');
            $endDate = now()->format('Y-m-d');

        } else {

            $startDate = $request->start_date;
            $endDate = $request->end_date;
        }
        $orders = OrderStat::query()
            ->selectRaw('DATE_FORMAT(purchase_date, "%Y-%m-%d") as purchase_date, sku')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereRaw('DATE(purchase_date) <= ?', [$endDate]);
                $query->whereRaw('DATE(purchase_date) >= ?', [$startDate]);
            })
            ->when($request->order_status, function ($query) use ($request) {
                $query->where('order_status', '=', $request->order_status);
            })
            ->get();

        $csvHeaders = [];
        $csvHeaders = ['sku', 'sales-channel'];
        $dates = $orders->groupBy('purchase_date');

        foreach ($dates as $key => $value) {
            $csvHeaders[] = $key;
        }

        $headers = [];
        foreach ($dates as $key => $value) {

            $headers[] = $key;

        }
        $skues = $orders->groupBy('sku');

        $skueData = [];
        foreach ($skues as $key => $value) {
            $skueData[] = $key;
        }

        $data = [];
        foreach ($skueData as $sku) {


            $salesChannels = OrderStat::query()
                ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                    $query->whereRaw('DATE(purchase_date) <= ?', [$endDate]);
                    $query->whereRaw('DATE(purchase_date) >= ?', [$startDate]);
                })
                ->where('sku', $sku)
                ->selectRaw('DISTINCT(sales_channel)')
                ->get();

            foreach ($salesChannels as $channel) {

                $array = [];
                $array[] = $sku;
                $array[] = $channel->sales_channel;

                foreach ($headers as $header) {

                    $count = OrderStat::query()
                        ->where('sales_channel', '=', $channel->sales_channel)
                        ->whereRaw('DATE(purchase_date) = ?', [$header])
                        ->where('sku', $sku)
                        ->selectRaw('sku, SUM(order_total) as order_total')
                        ->groupByRaw('sku')
                        ->first();
                    $array[] = $count->order_total ?? 0;
                }
                $data[] = $array;

            }


        }
        return [$csvHeaders, $data];
    }

}

<?php


namespace App\Services;


use App\Order;
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
        $orders = Order::query()
            ->selectRaw('user_id,sku ,sales_channel,DATE(purchase_date) as purchase_date, sku, SUM(quantity) as order_total')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereRaw('DATE(purchase_date) <= ?', [$endDate]);
                $query->whereRaw('DATE(purchase_date) >= ?', [$startDate]);
            })
            ->when($request->order_status, function ($query) use ($request) {
                $query->where('order_status', '=', $request->order_status);
            })
            ->groupByRaw('user_id,sku ,sales_channel,DATE(purchase_date), sku')
            ->get();


        $csvHeaders = [];
        $csvHeaders = ['sku', 'sales-channel'];
        $dates = $orders->groupBy('purchase_date');
        $salesChannels = $orders->unique('sales_channel');

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



            foreach ($salesChannels as $channel) {

                $array = [];
                $array[] = $sku;
                $array[] = $channel->sales_channel;

                foreach ($headers as $header) {

                    $count = $orders->where('sku', '=', $sku)
                        ->where('sales_channel', '=', $channel->sales_channel)
                        ->where('purchase_date', '=', $header)
                        ->sum('order_total');
                    $array[] = $count ?? 0;
                }
                $data[] = $array;

            }


        }
        return [$csvHeaders, $data];
    }

}

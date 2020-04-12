<?php


namespace App\Services;


use App\Order;
use App\OrderView;
use Illuminate\Http\Request;

class OrdersHTMLDataCreater
{
    public static function ordersData (Request $request)
    {
        $orders = OrderView::query()
            ->selectRaw('DATE_FORMAT(purchase_date, "%Y-%m-%d") as purchase_date, sku')
            ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                $query->whereRaw('DATE(purchase_date) <= ?', [$request->end_date]);
                $query->whereRaw('DATE(purchase_date) >= ?', [$request->start_date]);
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


            $salesChannels = OrderView::query()
                ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                    $query->whereRaw('DATE(purchase_date) <= ?', [$request->end_date]);
                    $query->whereRaw('DATE(purchase_date) >= ?', [$request->start_date]);
                })
                ->where('sku', $sku)
                ->selectRaw('DISTINCT(sales_channel)')
                ->get();

            foreach ($salesChannels as $channel) {

                $array = [];
                $array[] = $sku;
                $array[] = $channel->sales_channel;

                foreach ($headers as $header) {

                    $count = Order::query()
                        ->where('sales_channel', '=', $channel->sales_channel)
                        ->whereRaw('DATE(purchase_date) = ?', [$header])
                        ->where('order_status', '!=', 'Cancelled')
                        ->where('sku', $sku)
                        ->selectRaw('SUM(quantity) as  total, DATE_FORMAT(purchase_date, "%Y-%m-%d") as purchase_date')
                        ->groupByRaw('DATE_FORMAT(purchase_date, "%Y-%m-%d")')
                        ->first();
                    $array[] = $count->total ?? 0;
                }
                $data[] = $array;

            }


        }
        return [$csvHeaders, $data];
    }

}

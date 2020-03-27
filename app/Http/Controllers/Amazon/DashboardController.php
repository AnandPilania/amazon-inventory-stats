<?php

namespace App\Http\Controllers\Amazon;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index ()
    {
        $orders = Order::query()
            ->selectRaw('marketplace_id , DATE_FORMAT(purchase_date, "%Y-%d-%m") as purchase_date, sku, SUM(quantity) as sold')
            ->groupBy('purchase_date', 'sku', 'marketplace_id')
            ->paginate(20);

        return view('amazon.index', compact('orders'));
    }

    public function export (Request $request)
    {
        $orders = \DB::table('orders')
            ->selectRaw('marketplace_id , DATE_FORMAT(purchase_date, "%Y-%d-%m") as purchase_date, sku, SUM(quantity) as sold')
            ->groupBy('purchase_date', 'sku', 'marketplace_id')
            ->limit(50)
            ->get();

        $orders = $orders->groupBy([ 'purchase_date'] );

        dd($orders);

        $headers[] = 'sku';

        $fp = fopen('text.txt', 'wb');

        $data = [];
        foreach ($orders as $key => $lists) {
            $headers[] = $key;

            foreach ($lists as $list) {
                $data[$list->sku] = $list->sku;
            }
        }

        foreach ($data as $line) {
            $val = explode(",", $line);
            fputcsv($fp, $val);
        }
        fclose($fp);

    }
}

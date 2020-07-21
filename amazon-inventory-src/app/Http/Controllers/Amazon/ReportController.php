<?php

namespace App\Http\Controllers\Amazon;

use App\Http\Controllers\Controller;
use App\Inventory;
use App\Order;
use App\Services\OrdersHTMLDataCreater;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function export(Request $request)
    {

        [$csvHeaders, $data] = OrdersHTMLDataCreater::ordersData($request);

        $fp = fopen('data.csv', 'wb');

        fputcsv($fp, $csvHeaders);

        foreach ($data as $line) {
            fputcsv($fp, $line);
        }
        fclose($fp);

        return response()->download(public_path('data.csv'));
    }

    public function inventoryExport(Request $request)
    {
        $inventories = Inventory::query()
            ->selectRaw("sku ,asin, DATE(date) as date , in_stock_inventory_supply")
            ->groupByRaw('user_id,sku, DATE(date)')
            ->where('user_id', '=', auth()->id())
            ->get();

        $csvHeaders = [];
        $csvHeaders = ['sku'];
        $dates = $inventories->groupBy('date');

        foreach ($dates as $key => $value) {
            $csvHeaders[] = $key;
        }


        foreach ($dates as $key => $value) {

            $headers[] = $key;

        }
        $skues = $inventories->groupBy('sku');

        $skueData = [];
        foreach ($skues as $key => $value) {
            $skueData[] = $key;
        }

        $data = [];
        foreach ($skueData as $sku) {
            $array = [];
            $array[] =  $sku;

            foreach ($headers as $header) {

                $count = $inventories->where('sku', '=', $sku)
                    ->where('date', '=', $header)
                    ->first();
                $array[] = $count->in_stock_inventory_supply ?? 0;
            }
            $data[] = $array;


        }

        $fp = fopen('inventory.csv', 'wb');

        fputcsv($fp, $csvHeaders);

        foreach ($data as $line) {
            fputcsv($fp, $line);
        }
        fclose($fp);

        return response()->download(public_path('inventory.csv'));
    }
}

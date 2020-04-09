<?php

namespace App\Http\Controllers\Amazon;

use App\Http\Controllers\Controller;
use App\Marketplace;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index (Request $request)
    {

        $marketplace = Marketplace::query()->find($request->marketplace_id);


        $orders = Order::query()
            ->selectRaw('marketplace_id , DATE_FORMAT(purchase_date, "%Y-%m-%d") as purchase_date, sku, SUM(quantity) as sold')
            ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                $query->whereRaw('DATE(purchase_date) <= ?', [$request->end_date]);
                $query->whereRaw('DATE(purchase_date) >= ?', [$request->start_date]);
            })
            ->when($request->order_status, function ($query) use ($request) {
                $query->where('order_status', '=', $request->order_status);
            })
            ->when($marketplace, function ($query) use ($marketplace) {

                $code = $marketplace->code == 'GB' ? 'uk' : $marketplace->code;

                $query->where('sales_channel', 'like', "%" . $code . '%');
            })
            ->where('order_status', '!=', 'Cancelled')
            ->groupBy('sku', 'purchase_date')
            ->paginate(20);

        $marketplaces = $request->user()->marketplaces;
        return view('amazon.index', compact('orders', 'marketplaces'));
    }

    public function export (Request $request)
    {
        $orders = Order::query()
            ->selectRaw('DATE_FORMAT(purchase_date, "%Y-%m-%d") as purchase_date, sku, SUM(quantity) as sold')
            ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                $query->whereRaw('DATE(purchase_date) <= ?', [$request->end_date]);
                $query->whereRaw('DATE(purchase_date) >= ?', [$request->start_date]);
            })
            ->when($request->order_status, function ($query) use ($request) {
                $query->where('order_status', '=', $request->order_status);
            })
            ->where('order_status', '!=', 'Cancelled')
            ->groupBy('sku', 'purchase_date')
            ->get();


        $csvHeaders = [];

        $csvHeaders = ['sku'];
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

            $array = [];
            $array[] = $sku;

            foreach ($headers as $header) {

                $marketplace = Marketplace::query()->find($request->marketplace_id);

                $code = $marketplace->code == 'GB' ? 'uk' : $marketplace->code;

                $count = Order::query()
                    ->where('marketplace_id', $request->marketplace_id)
                    ->where('sales_channel', 'like', "%" . $code . '%')
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

        $fp = fopen('data.csv', 'wb');
        fputcsv($fp, $csvHeaders);

        foreach ($data as $line) {
            fputcsv($fp, $line);
        }
        fclose($fp);

        return response()->download(public_path('data.csv'));
    }


}

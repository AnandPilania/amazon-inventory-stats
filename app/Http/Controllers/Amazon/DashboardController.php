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
        $orders = Order::query()
            ->selectRaw('marketplace_id , DATE_FORMAT(purchase_date, "%Y-%d-%m") as purchase_date, sku, SUM(quantity) as sold')
            ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                $query->whereRaw('purchase_date < "' . $request->end_date . '"');
                $query->whereRaw('purchase_date > "' . $request->start_date . '"');
            })
            ->where('marketplace_id', $request->marketplace_id)
            ->groupBy('purchase_date', 'sku', 'marketplace_id')
            ->paginate(20);

        $marketplaces = Marketplace::all();

        return view('amazon.index', compact('orders', 'marketplaces'));
    }

    public function export (Request $request)
    {
        $orders = Order::query()
            ->selectRaw('marketplace_id , DATE_FORMAT(purchase_date, "%Y-%d-%m") as purchase_date, sku, SUM(quantity) as sold')
            ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                $query->whereRaw('purchase_date < "' . $request->end_date . '"');
                $query->whereRaw('purchase_date > "' . $request->start_date . '"');
            })
            ->where('marketplace_id', $request->marketplace_id)
            ->groupBy('purchase_date', 'sku', 'marketplace_id')
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


                $count = Order::query()
                    ->where('marketplace_id', $request->marketplace_id)
                    ->whereDate(DB::raw('DATE(purchase_date)'),'=' ,$header)
                    ->where('sku', $sku)
                    ->count();
                $array[] = $count;

            }

            $data[] = $array;

        }

        $fp = fopen('data.csv', 'wb');
        fputcsv($fp, $csvHeaders);

        foreach ( $data as $line ) {
            fputcsv($fp, $line);
        }
        fclose($fp);

        return response()->download(public_path('data.csv'));
    }


}

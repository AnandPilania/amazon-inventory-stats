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
            ->selectRaw('sales_channel ,DATE_FORMAT(purchase_date, "%Y-%m-%d") as purchase_date, sku, SUM(quantity) as sold')
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



}

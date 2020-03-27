<?php

namespace App\Http\Controllers\Amazon;

use App\Http\Controllers\Controller;
use App\Order;

class DashboardController extends Controller
{
    public function index ()
    {
        $orders = Order::query()
            ->selectRaw('marketplace_id , DATE_FORMAT(purchase_date, "%Y-%d-%m") as purchase_date, sku, SUM(quantity) as sold')
            ->groupBy('purchase_date', 'sku', 'marketplace_id')
            ->paginate(20);
//            ->get();

        return view('amazon.index', compact('orders'));
    }
}

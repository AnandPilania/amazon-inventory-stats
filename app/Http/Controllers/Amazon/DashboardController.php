<?php

namespace App\Http\Controllers\Amazon;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index ()
    {
        $data =   Order::query()
            ->selectRaw('marketplace_id , DATE_FORMAT(purchase_date, "%Y-%d-%m") as date, sku, SUM(quantity) as sold')
            ->groupBy('date','sku', 'marketplace_id')
            ->get()
            ->toArray();

        dd($data);
        return view('amazon.index');
    }
}

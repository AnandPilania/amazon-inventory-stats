<?php

namespace App\Http\Controllers\Amazon;

use App\Http\Controllers\Controller;
use App\Marketplace;
use App\Order;
use App\Services\OrdersHTMLDataCreater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index (Request $request)
    {
        [$htmlHeaders, $orders] = OrdersHTMLDataCreater::ordersData($request);
        $marketplaces = $request->user()->marketplaces;

        return view('amazon.index', compact('orders', 'htmlHeaders', 'marketplaces'));
    }


}

<?php

namespace App\Http\Controllers\Amazon;

use App\Http\Controllers\Controller;
use App\Order;
use App\Services\OrdersHTMLDataCreater;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function export (Request $request)
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

}

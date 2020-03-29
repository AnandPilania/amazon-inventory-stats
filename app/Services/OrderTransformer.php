<?php


namespace App\Services;


use App\Order;
use Carbon\Carbon;

class OrderTransformer
{
    public static function transform (array $orders, $reportRequest)
    {
        dump($reportRequest->marketplace->id);
        $transformedOrders = [];
        foreach ($orders as $order) {

            $transformedOrders[] = [
                'amazon_order_id' => $order [ "amazon-order-id" ],
                'merchant_order_id' => $order  [ "merchant-order-id" ],
                'purchase_date' => Carbon::parse($order  [ "purchase-date" ])->utc()->format('Y-m-d h:i:s'),
                'last_updated_date' => Carbon::parse($order [ "last-updated-date" ])->utc()->format('Y-m-d h:i:s'),
                'order_status' => $order [ "order-status" ],
                'fulfillment_channel' => $order  [ "fulfillment-channel" ],
                'sales_channel' => $order  [ "sales-channel" ],
                'order_channel' => $order [ "order-channel" ],
                'url' => $order [ "url" ],
                'ship_service_level' => $order [ "ship-service-level" ],
                'product_name' => $order [ "product-name" ],
                'sku' => $order [ "sku" ],
                'asin' => $order [ "asin" ],
                'quantity' => $order[ "quantity" ],
                'marketplace_id' => $reportRequest->marketplace->id ?? null,
                'report_id' => $reportRequest->id ?? null,
                'user_id' => $reportRequest->user->id,
            ];

        }
        return $transformedOrders;
    }

}

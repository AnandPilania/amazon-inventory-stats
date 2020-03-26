<?php


namespace App\Services;


use App\Order;

class OrderTransformer
{
    public static function transform (array $orders)
    {
        $transformedOrders = [];
        foreach ($orders as $order) {

            $transformedOrders[] = [
                'amazon_order_id' => $order [ "amazon-order-id" ],
                'merchant_order_id' => $order  [ "merchant-order-id" ],
                'purchase_date' => $order  [ "purchase-date" ],
                'last_updated_date' => $order [ "last-updated-date" ],
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

            ];

        }
        return $transformedOrders;
    }

}

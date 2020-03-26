<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'amazon_order_id',
        'merchant_order_id',
        'purchase_date',
        'last_updated_date',
        'order_status',
        'fulfillment_channel',
        'sales_channel',
        'order_channel',
        'url',
        'ship_service_level',
        'product_name',
        'sku',
        'asin',
        'user_id',
        'quantity',
    ];
}

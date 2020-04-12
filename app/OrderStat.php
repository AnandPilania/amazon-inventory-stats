<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStat extends Model
{
    //
    protected $fillable = [
        'user_id',
        'sku',
        'purchase_date',
        'sales_channel',
        'order_total',
    ];
}

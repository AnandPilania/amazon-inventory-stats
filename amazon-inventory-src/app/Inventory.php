<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'sku','asin','in_stock_inventory_supply', 'condition','date','user_id'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\OrderStat
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $user_id
 * @property string $sku
 * @property string $purchase_date
 * @property string $sales_channel
 * @property int $order_total
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStat query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStat whereOrderTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStat wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStat whereSalesChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStat whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderStat whereUserId($value)
 * @mixin \Eloquent
 */
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

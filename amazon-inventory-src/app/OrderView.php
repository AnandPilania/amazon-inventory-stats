<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\OrderView
 *
 * @property int $user_id
 * @property string|null $sku
 * @property string|null $sales_channel
 * @property string|null $purchase_date
 * @property float|null $order_total
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderView newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderView newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderView query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderView whereOrderTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderView wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderView whereSalesChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderView whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderView whereUserId($value)
 * @mixin \Eloquent
 */
class OrderView extends Model
{
    //
    protected $table = 'orders_by_date_view';
}

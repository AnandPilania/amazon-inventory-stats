<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Order
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $amazon_order_id
 * @property string|null $merchant_order_id
 * @property string|null $purchase_date
 * @property string|null $last_updated_date
 * @property string|null $order_status
 * @property string|null $fulfillment_channel
 * @property string|null $sales_channel
 * @property string|null $order_channel
 * @property string|null $url
 * @property string|null $ship_service_level
 * @property string|null $product_name
 * @property string|null $sku
 * @property string|null $asin
 * @property string $quantity
 * @property int $user_id
 * @property int|null $marketplace_id
 * @property int|null $report_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereAmazonOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereAsin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereFulfillmentChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereLastUpdatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereMarketplaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereMerchantOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereOrderChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereOrderStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereReportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereSalesChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereShipServiceLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUserId($value)
 * @mixin \Eloquent
 */
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
        'marketplace_id',
        'report_id',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Marketplace
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $amazon_marketplace_id
 * @property string $endpoint
 * @property string $code
 * @property int|null $region_id
 * @property-read \App\Region|null $region
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $user
 * @property-read int|null $user_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marketplace newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marketplace newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marketplace query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marketplace whereAmazonMarketplaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marketplace whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marketplace whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marketplace whereEndpoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marketplace whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marketplace whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marketplace whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marketplace whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Marketplace extends Model
{
    protected $fillable = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user ()
    {
        return $this->belongsToMany(User::class)->withPivot('mws_auth_token', 'seller_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region ()
    {
        return $this->belongsTo(Region::class);
    }
}

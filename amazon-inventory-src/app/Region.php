<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Region
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Marketplace[] $marketplaces
 * @property-read int|null $marketplaces_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ReportRequest[] $reportRequests
 * @property-read int|null $report_requests_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Region query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Region whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Region whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Region whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Region whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Region extends Model
{
    //
    public function marketplaces ()
    {
        return $this->hasMany(Marketplace::class);
    }

    public function reportRequests ()
    {
        return $this->hasMany(ReportRequest::class);
    }
}

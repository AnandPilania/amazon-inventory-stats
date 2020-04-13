<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ReportRequest
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $report_type
 * @property string $report_request_id
 * @property int|null $user_id
 * @property int|null $marketplace_id
 * @property string|null $status
 * @property string|null $mws_report_id
 * @property string|null $mws_report_fetched_at
 * @property string|null $start_date
 * @property string|null $end_date
 * @property int|null $region_id
 * @property-read \App\Marketplace|null $marketplace
 * @property-read \App\Region|null $region
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportRequest whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportRequest whereMarketplaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportRequest whereMwsReportFetchedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportRequest whereMwsReportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportRequest whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportRequest whereReportRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportRequest whereReportType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportRequest whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportRequest whereUserId($value)
 * @mixin \Eloquent
 */
class ReportRequest extends Model
{
    protected $table = 'mws_report_request';

    /**
     * @var array
     */
    protected $fillable = [
        'report_type',
        'report_request_id',
        'user_id',
        'marketplace_id',
        'status',
        'mws_report_id',
        'mws_report_fetched_at',
        'start_date',
        'end_date',
        'region_id'
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function marketplace ()
    {
        return $this->belongsTo(Marketplace::class, 'marketplace_id', 'id');
    }

    public function region ()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }
}

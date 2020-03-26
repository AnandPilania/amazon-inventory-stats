<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function marketplace ()
    {
        return $this->belongsTo(Marketplace::class);
    }
}

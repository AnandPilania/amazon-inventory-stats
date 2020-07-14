<?php

namespace App\Jobs\Amazon;

use App\Marketplace;
use App\Services\AmazonClient;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\RateLimitedMiddleware\RateLimited;

class RequestReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $marketplaceId;
    protected $reportType;
    protected $startDate;
    protected $endDate;
    protected $regionId;

    /**
     * RequestReportJob constructor.
     * @param User $user
     * @param $marketplaceId
     * @param string $reportType
     * @param null $startDate
     * @param null $endDate
     * @param null $regionId
     */
    public function __construct (
        User $user,
        $marketplaceId,
        $reportType = '_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_ORDER_DATE_',
        $startDate = null,
        $endDate = null,
        $regionId = null
    ) {
        $this->user = $user;
        $this->marketplaceId = $marketplaceId;
        $this->reportType = $reportType;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->regionId = $regionId;
    }


    public function middleware ()
    {
        $rateLimitedMiddleware = (new RateLimited())
            ->allow(3)
            ->everySeconds(180)
            ->releaseAfterMinutes(3);

        return [$rateLimitedMiddleware];
    }

    /**
     * This function will request the report and save the request id in the database
     *
     * @throws \Exception
     */
    public function handle ()
    {
        $marketplaceId = $this->marketplaceId;
        if (is_null($this->marketplaceId)) {

            $marketplaceId = $this->user->marketplaces()->where(['region_id' => $this->regionId])->first()->id;
        }
        $response = (new AmazonClient($this->user, $marketplaceId))
            ->requestReport($this->reportType, $this->startDate, $this->endDate);

        info($response);
        $reportRequest = $this->user->reportRequests()->create([
            'report_type' => $this->reportType,
            'report_request_id' => $response,
            'marketplace_id' => $this->marketplaceId,
            'start_date' => now()->subDays(2)->toDateTime(),
            'end_date' => now(),
            'region_id' => $this->regionId,
        ]);

        dispatch(new GetReportJob($reportRequest))->delay(60 * 5);

    }
}

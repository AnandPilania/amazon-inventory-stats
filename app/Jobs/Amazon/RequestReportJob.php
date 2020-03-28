<?php

namespace App\Jobs\Amazon;

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

    /**
     * RequestReportJob constructor.
     * @param User $user
     * @param $marketplaceId
     * @param string $reportType
     * @param $startDate
     * @param $endDate
     */
    public function __construct (
        User $user,
        $marketplaceId,
        $reportType = '_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_LAST_UPDATE_',
        $startDate = null,
        $endDate = null
    ) {
        $this->user = $user;
        $this->marketplaceId = $marketplaceId;
        $this->reportType = $reportType;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }


    public function middleware ()
    {
        $rateLimitedMiddleware = (new RateLimited())
            ->allow(1)
            ->everySeconds(80)
            ->releaseAfterSeconds(130);

        return [$rateLimitedMiddleware];
    }

    /**
     * This function will request the report and save the request id in the database
     *
     * @throws \Exception
     */
    public function handle ()
    {
        $response = (new AmazonClient($this->user, $this->marketplaceId))
            ->requestReport($this->reportType, $this->startDate, $this->endDate);


        $reportRequest = $this->user->reportRequests()->create([
            'report_type' => $this->reportType,
            'report_request_id' => $response,
            'marketplace_id' => $this->marketplaceId,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
        ]);

        dispatch(new GetReportJob($reportRequest))->delay(5);

    }
}

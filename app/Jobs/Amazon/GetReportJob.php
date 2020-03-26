<?php

namespace App\Jobs\Amazon;

use App\ReportRequest;
use App\Services\AmazonClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\RateLimitedMiddleware\RateLimited;

class GetReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $reportRequest;

    /**
     * Create a new job instance.
     *
     * @param ReportRequest $reportRequest
     */
    public function __construct (ReportRequest $reportRequest)
    {
        $this->reportRequest = $reportRequest;
    }

    public function middleware ()
    {
        $rateLimitedMiddleware = (new RateLimited())
            ->allow(60)
            ->everyMinute()
            ->releaseAfterSeconds(15);

        return [$rateLimitedMiddleware];
    }

    /**
     * @throws \Exception
     */
    public function handle ()
    {
        $amazonClient = new AmazonClient($this->reportRequest->user, $this->reportRequest->marketplace->id);

        $reportData = $amazonClient->getReport($this->reportRequest->report_request_id);

        if ($reportData) {

            $this->delete();
        }

        dispatch(
            new GetReportJob($this->reportRequest)
        )->delay(10);

    }
}

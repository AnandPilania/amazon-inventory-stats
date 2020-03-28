<?php

namespace App\Jobs\Amazon;

use App\Order;
use App\ReportRequest;
use App\Services\AmazonClient;
use App\Services\OrderTransformer;
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
            ->allow(1)
            ->everySeconds(60)
            ->releaseAfterSeconds(130);

        return [$rateLimitedMiddleware];
    }

    /**
     * @throws \Exception
     */
    public function handle ()
    {
        $amazonClient = new AmazonClient($this->reportRequest->user, $this->reportRequest->marketplace->id);

        $reportData = $amazonClient->getReport($this->reportRequest->report_request_id);

        if ($reportData == false) {
            dispatch(
                new GetReportJob($this->reportRequest)
            )->delay(20);
            $this->delete();

        } else {

            $this->saveOrders($orders = OrderTransformer::transform($reportData, $this->reportRequest));
            $this->reportRequest->status = '_DONE_';
            $this->reportRequest->mws_report_fetched_at = now();
            $this->reportRequest->update();
        }

    }

    public function saveOrders ($orders)
    {
        foreach ($orders as $order) {
            Order::query()
                ->updateOrInsert(['amazon_order_id' => $order[ 'amazon_order_id' ]], $order);
        }
    }
}

<?php

namespace App\Jobs\Amazon;

use App\Marketplace;
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
            ->allow(5)
            ->everySeconds(80)
            ->releaseAfterMinutes(2);

        $this->attempts();
        return [$rateLimitedMiddleware];
    }

    /**
     * @throws \Exception
     */
    public function handle ()
    {


        if (!isset($this->reportRequest->marketplace->id)) {

            $marketplaceId = $this->reportRequest->user->marketplaces()->where(['region_id' => $this->reportRequest->region->id])->first()->id;
        } else {
            $marketplaceId = $this->reportRequest->marketplace->id;
        }
        info('this is test');
        $amazonClient = new AmazonClient($this->reportRequest->user, $marketplaceId);

        $reportData = $amazonClient->getReport($this->reportRequest->report_request_id);

        if ($reportData == false) {
            dispatch(
                new GetReportJob($this->reportRequest)
            )->delay(180);
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
                ->updateOrInsert(
                    [
                        'amazon_order_id' => $order[ 'amazon_order_id' ],
                        'sales_channel' => $order[ 'sales_channel' ],
                    ], $order);
        }
    }
}

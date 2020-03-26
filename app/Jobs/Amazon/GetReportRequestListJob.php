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

class GetReportRequestListJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $reportRequest;


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
        dump('Requested Job Id', $this->reportRequest->id);
        $amazonClient = new AmazonClient($this->reportRequest->user, $this->reportRequest->marketplace->id);
        $lists = $amazonClient->getReportRequestList([
            $this->reportRequest->report_type,
        ]);

        if (isset($lists[ 'GetReportListResult' ][ 'ReportInfo' ])) {
            dump('I am inside');
            $this->reports($lists[ 'GetReportListResult' ][ 'ReportInfo' ]);
        } else {
            dump('I am outside if', $lists);

        }


    }

    public function reports ($list)
    {

        dump('=======================asdasd=================');

        dump($this->reportRequest->report_request_id , $list[ 'ReportRequestId' ], $list);
//        if ($this->reportRequest->report_request_id == $list[ 'ReportRequestId' ]) {

            $this->reportRequest->mws_report_id =  '19798226871018347'// $list[ 'ReportId' ];
;            $this->reportRequest->update();
            dispatch(new GetReportJob($this->reportRequest));

//        }

        dump('=======================asdasd=================');

    }
}

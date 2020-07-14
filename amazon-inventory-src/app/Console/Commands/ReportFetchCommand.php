<?php

namespace App\Console\Commands;

use App\Jobs\Amazon\GetReportJob;
use App\User;
use Illuminate\Console\Command;

class ReportFetchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mws:reportfetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Iterate over each report and check the status to get the data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct ()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle ()
    {
        $users = User::query()->whereHas('marketplaces')->get();

        foreach ($users as $user) {

            $reports = $user->reportRequests()
                ->whereNull('mws_report_fetched_at')->get();

            $counter = 0;
            foreach ($reports as $report) {

                $counter = $counter + 80;
                dispatch(new GetReportJob($report))->delay($counter);
            }

        }
    }
}

<?php

namespace App\Console\Commands;

use App\Jobs\Amazon\RequestReportJob;
use App\User;
use Illuminate\Console\Command;

class RequestReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mws:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Request Report';

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

        $users = User::all();

        $counter = 0;
        foreach ($users as $user) {

            $marketplaces = $user->marketplaces;
            $regions = $marketplaces->unique('region_id')->pluck('region_id');

            foreach ($regions as $region) {

//                $counter = $counter + 60;
                dispatch(new RequestReportJob(
                    $user,
                    null,
                    '_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_ORDER_DATE_',
                    now()->subDays(3)->toDateTime(),
                    now()->toDateTime(),
                    $region

                ));
            }

        }

    }
}

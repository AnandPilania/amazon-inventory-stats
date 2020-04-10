<?php

namespace App\Console\Commands\Amazon;

use App\Jobs\Amazon\RequestReportJob;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PastDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mws:pastdata

      {--startDate= :Enter the start date}
      {--endDate= : Enter End date }
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch the past data';

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

        $startDate = $this->option('startDate');
        $endDate = $this->option('endDate');

        $users = User::all();

        $counter = 60;
        $endDate = now()->subMonths(2);

        $index = 1;
        while (now() > $endDate) {

            $startDateTime = $endDate->toDateTime();
            $endDateTime = $endDate->addMonths(1)->toDateTime();
            foreach ($users as $user) {

                $marketplaces = $user->marketplaces;
                $regions = $marketplaces->unique('region_id')->pluck('region_id');

                foreach ($regions as $region) {

                    $counter = $counter + 20;
                    dump(

                        '_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_ORDER_DATE_',
                        $startDate,
                        $endDate,
                        $index++

                    );

                    dispatch(new RequestReportJob(
                        $user,
                        null,
                        '_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_ORDER_DATE_',
                        $startDateTime,
                        $endDateTime,
                        $region

                    ))
                        ->delay($counter);

                }

            }
        }

    }
}

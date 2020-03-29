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

//        Carbon::parse();
        $users = User::all();

        $counter = 60;
        $endDate = now()->subMonths(24);

        $index = 1;
        while (now() > $endDate) {

            $startDateTime = $endDate->toDateTime();
            $endDateTime = $endDate->addMonths(1)->toDateTime();
            foreach ($users as $user) {

                $marketplaces = $user->marketplaces;

                foreach ($marketplaces as $marketplace) {

                    $counter = $counter + 120;
                    dump(

                        $marketplace->id,
                        '_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_LAST_UPDATE_',
                        $startDate,
                        $endDate,
                        $index++

                    );

                    dispatch(new RequestReportJob(
                        $user,
                        $marketplace->id,
                        '_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_LAST_UPDATE_',
                        $startDateTime,
                        $endDateTime

                    ))
                        ->delay($counter);

                }

            }
        }
        dump('Counter => ' . $index);

    }
}

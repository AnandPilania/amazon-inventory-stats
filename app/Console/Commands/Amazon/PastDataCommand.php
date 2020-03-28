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

        Carbon::parse();
        $users = User::all();

        $endDate = now()->subDays(5);

        while (now() > $endDate) {
            foreach ($users as $user) {

                $marketplaces = $user->marketplaces;

                foreach ($marketplaces as $marketplace) {

                    sleep(3);
                    dump($user,
                        $marketplace->id,
                        '_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_LAST_UPDATE_',
                        $endDate->toDateTime(),
                        $endDate->addDays(2)->toDateTime()
                    );

                    dispatch(new RequestReportJob(
                        $user,
                        $marketplace->id,
                        '_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_LAST_UPDATE_',
                        $endDate->toDateTime(),
                        $endDate->addDays(2)->toDateTime()

                    ))->delay(20);
                }

            }
            $endDate = $endDate->addDay();
        }

    }
}

<?php

namespace App\Console\Commands\Amazon;

use App\Jobs\Amazon\RequestReportJob;
use App\User;
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

        $users = User::all();

        foreach ($users as $user) {

            $marketplaces = $user->marketplaces;

            foreach ($marketplaces as $marketplace) {

                dispatch(new RequestReportJob(
                    $user,
                    $marketplace->id
                ));
            }

        }

    }
}

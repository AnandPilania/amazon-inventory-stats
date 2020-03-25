<?php

namespace App\Providers;

use App\Services\AmazonClient;
use Illuminate\Support\ServiceProvider;
use function foo\func;

class AmazonClientProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register ()
    {
        $this->app->bind(AmazonClient::class, function ($app, $params) {

            return new AmazonClient();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot ()
    {
        //
    }
}

<?php

namespace Laravel\SparkInstaller;

use GuzzleHttp\Client as HttpClient;

trait InteractsWithSparkAPI
{
    /**
     * The Spark base URL.
     *
     * @var string
     */
    protected $sparkUrl = 'https://spark.laravel.com';

    /**
     * Get the latest Spark release version.
     *
     * @return string
     */
    protected function latestSparkRelease()
    {
        return json_decode((string) (new HttpClient)->get(
            $this->sparkUrl.'/api/releases/version', ['verify' => __DIR__.'/cacert.pem']
        )->getBody())->version;
    }
}

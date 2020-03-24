<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Marketplace;
use Faker\Generator as Faker;

$factory->define(Marketplace::class, function (Faker $faker) {
    return [
        'marketplace_name' => $faker->country,
        'amazon_marketplace_id' => \Illuminate\Support\Str::random(15),
        'domain' => $faker->domainName
    ];
});

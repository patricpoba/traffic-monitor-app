<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\HttpRequest;
use Faker\Generator as Faker;

$factory->define(HttpRequest::class, function (Faker $faker) {
    return [
        'request' => $faker->text,
        'response' => $faker->text,
        'url' => $faker->url,
        'referral_url' => $faker->url,
        'ip' => $faker->ipv4,
        'headers' => $faker->text,
        'user_agent' => $faker->userAgent,
        'location' => $faker->word
    ];
});

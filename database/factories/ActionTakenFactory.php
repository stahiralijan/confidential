<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\ActionTaken;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(ActionTaken::class, function (Faker $faker) {
    return [
        'enquiry_id' => random_int(1, 10),
        'enquiry_detail_id' => random_int(1, 10),
        'employee_id' => random_int(1, 10),
        'penalty_id' => random_int(1, 10),
        'description' => $faker->sentence()
    ];
});
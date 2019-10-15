<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Employee;
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

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'fullname' => $faker->sentence(),
        'cnic' => $faker->sentence(),
        'code' => $faker->sentence(),
        'mobile_number' => $faker->sentence(),
        'bps' => $faker->sentence(),
        'office_id' => random_int(0, 9223372036854775807),
        'designation_id' => random_int(0, 9223372036854775807)
    ];
});
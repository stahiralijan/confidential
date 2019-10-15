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
        'fullname' => $faker->name(),
        'cnic' => random_int(1730576073029, 4751573069709),
        'code' => $faker->postcode,
        'mobile_number' => '0' . random_int(3331234567, 34398765432),
        'office_id' => random_int(1, 10),
        'designation_id' => random_int(1, 10)
    ];
});
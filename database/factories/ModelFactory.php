<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'role' => 'admin',
        'remember_token' => str_random(10),
    ];
});

///** @var \Illuminate\Database\Eloquent\Factory $factory */
//$factory->define(App\Models\Market::class, function (Faker\Generator $faker) {
//    return [
//        'name' => $faker->name,
//        'description' => $faker->text(200),
//        'details' => json_encode(['website' => 'http://www.' . $faker->domainName]),
//    ];
//});
//
///** @var \Illuminate\Database\Eloquent\Factory $factory */
//$factory->define(App\Models\Currency::class, function (Faker\Generator $faker) {
//    return [
//        'name' => $faker->text(10),
//        'symbol' => $faker->word,
//        'description' => $faker->text(200),
//    ];
//});
<?php

use Illuminate\Support\Facades\Hash;

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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name'     => $faker->name,
        'email'    => $faker->unique()->email,
        'password' => Hash::make('12345'),
    ];
});


$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->title,
        'colors' => json_encode( [$faker->hexColor,$faker->hexColor,$faker->hexColor] ),
        'likes' => rand(0,100),
        'image' => 'https://picsum.photos/id/'.rand(0,1000).'/800/500',
        'description' => $faker->text(),
        'tags' => json_encode( [$faker->text(10),$faker->text(10),$faker->text(10)] ),
        'url' => $faker->url,
        'slug' => $faker->url,
    ];
});
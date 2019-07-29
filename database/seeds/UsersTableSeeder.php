<?php

use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        // create 10 users using the user factory
        DB::table('users')->insert([

            'name'     => $faker->name,
            'email'    => $faker->unique()->email,
            'password' => Hash::make('12345'),
            
        ]);
    }
}
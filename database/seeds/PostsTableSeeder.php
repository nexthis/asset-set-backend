<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,100) as $index) {
            DB::table('posts')->insert([
                'title' => $faker->title,
                'colors' => json_encode( [$faker->hexColor,$faker->hexColor,$faker->hexColor] ),
                'likes' => rand(0,100),
                'image' => 'https://picsum.photos/id/'.rand(0,1000).'/800/500',
                'description' => $faker->text(),
                'tags' => json_encode( [$faker->text(10),$faker->text(10),$faker->text(10)] ),
                'url' => $faker->url,
                'slug' => $faker->url,
            ]);
        }
    }
}

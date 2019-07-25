<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1,100) as $index) {
            DB::table('posts')->insert([
                'title' => Str::random(10),
                'colors' => Str::random(10),
                'likes' => rand(0,100),
                'image' => 'https://picsum.photos/id/'.rand(0,1000).'/800/500'
            ]);
        }
    }
}

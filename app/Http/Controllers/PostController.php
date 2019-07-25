<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(){
        return Post::all();
    }

    public function paginate(){
        $posts = DB::table('posts')->paginate(5);
        return $posts;
    }
    
}

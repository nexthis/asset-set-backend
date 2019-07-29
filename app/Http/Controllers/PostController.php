<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    public function index(Request $request){
        $posts = Post::all();
        
        if($request->_order=='DESC')
            $posts = $posts->sortByDesc($request->_sort);
        else 
            $posts =  $posts->sortBy($request->_sort);

        $posts = $posts->whereBetween('id',[$request->_start,$request->_end])->values()->all();

        return response( $posts )->header('X-Total-Count',Post::all()->count());
    }

    public function show($request){

        return response(Post::find($request) )->header('X-Total-Count',1);
    }

    public function update(Request $request){
        $post = Post::find($request->id);

        $post->title = $request->title;

        $post->title = $request->colors;
        $post->description = $request->description;
        $post->tags = $request->tags;
        $post->url = $request->url;
        $post->slug = str_slug($request->title);
        $post->image = $request->image;
        $post->likes = $request->likes;

        if(isset($request->image[0]['src'])){
            $image = substr($request->image[0]['src'], strpos($request->image[0]['src'], ',') + 1);
            $image = base64_decode( $image);
            $name = $request->title.'.'.time().'.jpeg';
            $path = 'posts/'.$name;
            Storage::put($path, $image);

        }
        
        return  $request;
        $post->save();

    }

    public function paginate(){
        $posts = DB::table('posts')->paginate(10);
        return $posts;
    }
    
}

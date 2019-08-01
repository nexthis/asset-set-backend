<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
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

    //Request $request or Post $request
    public function update(Request $request){
        $post = Post::find($request->id);

        $post->title = $request->title;

        $post->colors = $request->colors;
        $post->description = $request->description;
        $post->tags = $request->tags;
        $post->url = $request->url;
        $post->slug = str_slug($request->title);
        $post->likes = $request->likes;

        //TODO change to file 
        if(isset($request->image[0]['src'])){

            $image = substr($request->image[0]['src'], strpos($request->image[0]['src'], ',') + 1);
            $image = base64_decode( $image);
            $name = $request->title.'.'.time().'.jpeg';
            $path = 'posts/'.$name;
            $this->removeImage($post->image);
            $post->image = URL::asset('storage').'/'.$path;
            Storage::put($path, $image);
        }
        
        $post->save();
        return  $post;
    }

    public function create(Request $request){
        $post = new Post();

        $post->title = $request->title;

        $post->colors = $request->colors;
        $post->description = $request->description;
        $post->tags = $request->tags;
        $post->url = $request->url;
        $post->slug = str_slug($request->title);

        //TODO change to file 
        if(isset($request->image[0]['src'])){
            $image = substr($request->image[0]['src'], strpos($request->image[0]['src'], ',') + 1);
            $image = base64_decode( $image);
            $name = $request->title.'.'.time().'.jpeg';
            $path = 'posts/'.$name;
            $post->image = URL::asset('storage').'/'.$path;
            Storage::put($path, $image);
        }
        
        $post->save();
        return  $post;
    }
    
    public function delete( $id){
        $post = Post::find($id);
        $this->removeImage($post->image);
        Post::destroy($id);
        return $post;
    }

    private function removeImage($imgPath){
        $path =str_replace(URL::asset('storage').'/','', $imgPath); 
        Storage::delete([$path]);
    }

    public function paginate(){
        $posts = DB::table('posts')->paginate(10);
        return $posts;
    }
    
}

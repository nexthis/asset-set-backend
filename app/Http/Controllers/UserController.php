<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller{

    public function index(Request $request){
        $users = User::all();
        
        if($request->_order=='DESC')
            $users = $users->sortByDesc($request->_sort);
        else 
            $users =  $users->sortBy($request->_sort);

        $users = $users->whereBetween('id',[$request->_start,$request->_end])->values()->all();

        return response( $users )->header('X-Total-Count',User::all()->count());
    }
}
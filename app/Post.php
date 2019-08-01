<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = [];
    protected $casts  = [
        'colors'=>'array',
        'tags'=>'array'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;
     protected $fillable = [

        'id',
        'user_id',
        'cat_id',
        'title',
        'detail',
        'thumb',
        'full_img',
        'tags',


    ];

    function comments(){

     // return $this->hasMany(Comment::class);
      return $this->hasMany('App\Models\Comment')->orderBy('id', 'desc');
    }

    function category(){
 return $this->belongsTo('App\Models\Category', 'cat_id');
    }
}

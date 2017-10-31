<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // specify which model attributes you want to make mass assignable
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'body'
    ];

    // set up the relationship with Category model
    public function category() {
        return $this->belongsTo('App\Category');
    }
}

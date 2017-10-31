<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // specify which table to use
    protected $table = 'categories';

    // specify which model attributes you want to make mass assignable
    protected $fillable = [
        'name'
    ];

    // set up the relationship with Post model
    public function posts() {
        return $this->hasMany('App\Post');
    }
}

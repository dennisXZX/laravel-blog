<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // set up the relationship with Post model
    public function posts() {
        return $this->belongsToMany('App\Post');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // set up the relationship with Post model
    public function post() {
        return $this->belongsTo('App\Post');
    }
}

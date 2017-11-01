<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    protected function getIndex() {
        // set the number of items displayed per page
        // in the view, you can display the pagination using {{ $posts->links() }}
        $posts = Post::paginate(5);

        return view('blog.index')->withPosts($posts);
    }

    public function getSingle($slug) {
        // fetch from database based on slug
        // first() will retrieve a single model instance, instead of a collection of models
        $post = Post::where('slug', '=', $slug)->first();

        return view('blog.single')->withPost($post);
    }
}

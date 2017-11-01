<?php

namespace App\Http\Controllers;

use App\Post;

class PagesController extends Controller {

    public function getIndex() {
        // since Post is a model, Post:: indicates 'SELECT * FROM posts'
        // get() returns a collection of models
        $posts = Post::orderBy('created_at', 'desc')->take(4)->get();

        return view('pages.welcome')->withPosts($posts);
    }

    public function getAbout() {
        return view('pages.about');
    }

    public function getContact() {
        return view('pages.contact');
    }

}
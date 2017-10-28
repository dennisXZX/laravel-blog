<?php

namespace App\Http\Controllers;

use App\Post;

class PagesController extends Controller {

    public function getIndex() {
        // since Post is a model, Post:: indicates 'SELECT * FROM posts'
        $posts = Post::orderBy('created_at', 'desc')->take(4)->get();

        return view('pages.welcome')->withPosts($posts);
    }

    public function getAbout() {
        $first = 'Dennis';
        $last = 'Xiao';

        $fullname = $first . ' ' . $last;
        $email = 'dennisboys@gmail.com';
        $data = [];
        $data['email'] = $email;
        $data['fullname'] = $fullname;
        return view('pages.about')->withData($data);
    }

    public function getContact() {
        return view('pages.contact');
    }

}
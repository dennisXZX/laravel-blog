<?php

namespace App\Http\Controllers;

use App\Post;
use Mail;
use Session;
use Illuminate\Http\Request;

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

    public function postContact(Request $request) {
        // validate the data
        // https://laravel.com/docs/5.5/validation#rule-required
        $request->validate([
            'email' => 'required|email',
            'subject'  => 'required',
            'bodyMessage' => 'required'
        ]);

        $data = [
            'email' => $request->email,
            'subject' => $request->subject,
            'bodyMessage' => $request->bodyMessage
        ];

        // send the mail
        Mail::send('emails.contact', $data, function($message) use ($data) {
            $message->from($data['email']);
            $message->to('hello@dennisxiao.com');
            $message->subject($data['subject']);
        });

        // generate a flash message which is stored in session
        // you can change session setting in config/session.php
        Session::flash('success', 'Your email was sent!');

        return redirect('/');
    }

}
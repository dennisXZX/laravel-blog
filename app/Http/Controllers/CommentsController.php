<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Session;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        // validate the data
        // https://laravel.com/docs/5.5/validation#rule-required
        $request->validate([
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255',
            'comment'  => 'required|max:2000'
        ]);

        $post = Post::find($post_id);

        $comment = new Comment();
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->approved = true;
        $comment->post()->associate($post);

        $comment->save();

        // generate a flash message which is stored in session
        // you can change session setting in config/session.php
        Session::flash('success', 'The comment was successfully added!');

        // redirect to a named route 'blog.single', which expects a slug parameter blog/{slug}
        return redirect()->route('blog.single', [$post->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('comments.edit')->withComment($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        // validate the data
        // https://laravel.com/docs/5.5/validation#rule-required
        $request->validate([
            'comment' => 'required',
        ]);

        // update the comment
        $comment->comment = $request->comment;

        $comment->save();

        // generate a flash message which is stored in session
        // you can change session setting in config/session.php
        Session::flash('success', 'The comment was successfully updated!');

        // redirect to a named route 'posts.show', which expects a post parameter posts/{post}
        // when the Post object is saved to the database, it should have a new id property
        return redirect()->route('posts.show', $comment->post->id);

    }

    public function delete($id)
    {
        $comment = Comment::find($id);

        return view('comments.delete')->withComment($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        // save the post id before the comment is being deleted
        $post_id = $comment->post->id;

        $comment->delete();

        // generate a flash message which is stored in session
        // you can change session setting in config/session.php
        Session::flash('success', 'The comment was successfully deleted!');

        return redirect()->route('posts.show', $post_id);
    }
}

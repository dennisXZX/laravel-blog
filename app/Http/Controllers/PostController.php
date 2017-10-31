<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Session;

class PostController extends Controller
{

    public function __construct() {
        // only authenticated users can access
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // order the result in descending order and retrieve first 5 posts
        $posts = Post::orderBy('updated_at', 'desc')->paginate(5);

        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // retrieve all categories
        $categories = Category::all();

        return view('posts.create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        // https://laravel.com/docs/5.5/validation#rule-required
        $request->validate([
            'title'         => 'required|max:255',
            'slug'          => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id'   => 'required|integer',
            'body'          => 'required'
        ]);

        // store the post into the database
        $post = Post::create($request->all());

        // generate a flash message which is stored in session
        // you can change session setting in config/session.php
        Session::flash('success', 'The post was successfully saved!');

        // redirect to a named route 'posts.show', which expects a post parameter posts/{post}
        // when the Post object is saved to the database, it should have a new id property
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find the post with the passed in id from database
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $categoriesArray = [];

        foreach ($categories as $category) {
            $categoriesArray[$category->id] = $category->name;
        }

        return view('posts.edit')->withPost($post)
                                      ->withCategoriesArray($categoriesArray);
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
        // validate the data
        // https://laravel.com/docs/5.5/validation#rule-required
        $request->validate([
            'title' => 'required|max:255',
            'slug'  => 'required|alpha_dash|min:5|max:255',
            'body'  => 'required'
        ]);

        // update the post
        $post = Post::findOrFail($id);
        $post->update($request->all());

        // generate a flash message which is stored in session
        // you can change session setting in config/session.php
        Session::flash('success', 'The post was successfully changed!');

        // redirect to a named route 'posts.show', which expects a post parameter posts/{post}
        // when the Post object is saved to the database, it should have a new id property
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete the post from database
        $post = Post::destroy($id);

        // generate a flash message which is stored in session
        // you can change session setting in config/session.php
        Session::flash('success', 'The post was successfully deleted!');

        return redirect()->route('posts.index');
    }
}

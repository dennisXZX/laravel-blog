<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Storage;
use Mews\Purifier\Facades\Purifier;
use Intervention\Image\Facades\Image;
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
        // order the result in descending order and retrieve the first 5 posts
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
        // retrieve all categories and tags
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create')->withCategories($categories)
                                        ->withTags($tags);
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
            'title'          => 'required|max:255',
            'slug'           => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id'    => 'required|integer',
            'body'           => 'required',
            'featured_image' => 'sometimes|image'
        ]);

        // store the post into the database
        $post = new Post;

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        // purify dangerous HTML tags such as <script>
        $post->body = Purifier::clean($request->body);

        // save images
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/') . $filename;
            // use Intervention Image library to process the image
            Image::make($image)->resize(800, 400)->save($location);

            // store in database
            $post->image = $filename;
        }

        $post->save();

        // set the association between post and tags
        $post->tags()->sync($request->tags);

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

        $tags = Tag::all();
        $tagsArray = [];

        // put all categories into an array
        foreach ($categories as $category) {
            $categoriesArray[$category->id] = $category->name;
        }

        // put all tags into an array
        foreach ($tags as $tag) {
            $tagsArray[$tag->id] = $tag->name;
        }

        return view('posts.edit')->withPost($post)
                                      ->withCategoriesArray($categoriesArray)
                                      ->withTagsArray($tagsArray);
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
            'title'          => 'required|max:255',
            'slug'           => "required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
            'body'           => 'required',
            'featured_image' => 'image'
        ]);

        // update the post
        $post = Post::findOrFail($id);

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = clean($request->body);

        // check if there is a new feature image uploaded
        if ($request->hasFile('featured_image')) {
            // add the new photo
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/') . $filename;
            // use Intervention Image library to process the image
            Image::make($image)->resize(800, 400)->save($location);
            // retrieve the old file name
            $oldFileName = $post->image;
            // update the database
            $post->image = $filename;
            // delete the old photo
            // for local development, need to update the 'root' property in 'config/filesystems.php'
            // to 'root' => public_path('images/'),
            Storage::delete($oldFileName);
        }

        $post->save();

        // check if there is any tag
        if (isset($request->tags)) {
            // set the association between post and tags
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync([]);
        }

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
        // find the post
        $post = Post::find($id);

        // remove the relationship with tags
        $post->tags()->detach();

        // delete the featured image associated with the post
        Storage::delete($post->image);

        // delete the post from database
        $post->delete();

        // generate a flash message which is stored in session
        // you can change session setting in config/session.php
        Session::flash('success', 'The post was successfully deleted!');

        return redirect()->route('posts.index');
    }
}

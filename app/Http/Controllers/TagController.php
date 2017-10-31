<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Session;

class TagController extends Controller
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
        $tags = Tag::all();

        return view('tags.index')->withTags($tags);
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
            'name' => 'required|max:255|unique:tags,name'
        ]);

        // store the tag into the database
        Tag::create($request->all());

        // generate a flash message which is stored in session
        // you can change session setting in config/session.php
        Session::flash('success', 'New tag was successfully created!');

        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        return view('tags.show')->withTag($tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('tags.edit')->withTag($tag);
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
        $tag = Tag::find($id);

        // validate the data
        // https://laravel.com/docs/5.5/validation#rule-required
        $request->validate([
            'name' => 'required|max:255|unique:tags,name'
        ]);

        $tag->name = $request->name;
        $tag->save();

        // generate a flash message which is stored in session
        // you can change session setting in config/session.php
        Session::flash('success', 'Successfully saved your new tag!');

        return redirect()->route('tags.show', $tag->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

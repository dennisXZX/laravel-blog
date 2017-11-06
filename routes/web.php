<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
*  authentication routes
*/
Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

/*
*  blog routes
*/

// use where method to constrain the format of route parameters
// [\w\d\-\_]+ means the slug must be composed of any number of word, digit, '-' and '_'
Route::get('blog/{slug}', 'BlogController@getSingle')
        ->name('blog.single')
        ->where('slug', '[\w\d\-\_]+');

Route::get('blog', 'BlogController@getIndex')
        ->name('blog.index');

/*
*  comment routes
*/

Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
Route::get('comments/{id}/edit', ['uses' => 'CommentsController@edit', 'as' => 'comments.edit']);
Route::put('comments/{id}', ['uses' => 'CommentsController@update', 'as' => 'comments.update']);
Route::delete('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);

/*
*  page routes
*/

Route::get('contact', 'PagesController@getContact');
Route::post('contact', 'PagesController@postContact');

Route::get('about', 'PagesController@getAbout');

Route::get('/', 'PagesController@getIndex');

/*
*  resource routes
*/

Route::resource('posts', 'PostController');
Route::resource('categories', 'CategoryController', ['except' => 'create']);
Route::resource('tags', 'TagController', ['except' => 'create']);
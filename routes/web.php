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

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

// use where method to constrain the format of route parameters
// [\w\d\-\_]+ means the slug must be composed of any number of word, digit, '-' and '_'
Route::get('blog/{slug}', 'BlogController@getSingle')
        ->name('blog.single')
        ->where('slug', '[\w\d\-\_]+');

Route::get('blog', 'BlogController@getIndex')
        ->name('blog.index');

Route::get('contact', 'PagesController@getContact');

Route::get('about', 'PagesController@getAbout');

Route::get('/', 'PagesController@getIndex');

Route::resource('posts', 'PostController');

<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//handles the home page request which displays the top stories/Timeline stories
Route::get('/', 'TimelineStoryController@index');

//Handles the various category request
Route::get('entertainment', function()
{
    return view('category');
});
Route::get('nigeria', function()
{
    return view('category');
});

Route::get('metro', function()
{
    return view('category');
});

Route::get('politics', function()
{
    return view('category');
});

Route::get('sports', function()
{
    return view('category');
});


Route::get('blade', function () {
    return view('category');
});
Route::get('/fullStory', function()
{
    return view('fullStory');
});

Route::get('/index', function()
{
    return view('index');
});

Route::get('/fullStory2', function()
{
    return view('fullStory2');
});
Route::get('/fullStory3', function()
{
    return view('fullStory3');
});
// handles the fetch feeds request
Route::get('feeds', 'FeedController@test');

Route::get('test', 'FeedController@test');

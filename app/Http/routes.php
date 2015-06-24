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

Route::get('/', function () {
    return view('index');
});
Route::get('/category', function()
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
Route::get('feeds', 'FeedController@fetchFeeds');

Route::get('test', 'FeedController@test');

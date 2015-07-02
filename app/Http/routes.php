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
    return view('welcome');
});

// handles the fetch feeds request
Route::get('feeds', 'FeedController@fetchFeeds');

// handles the fetch feeds request
Route::get('test', 'RawStoryController@matchStory');

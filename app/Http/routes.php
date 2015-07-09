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

// Handles the response of stories in Json format
Route::get('/stories_json','TimelineStoryController@getStoriesJson');


Route::get('test', 'FeedController@test');

Route::get('timeline', 'StoryController@createTimelineStory');

//Handles the various category request
Route::get('{request_name}', 'TimelineStoryController@handleRequest');


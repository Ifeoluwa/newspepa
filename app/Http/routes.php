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

Route::get('search', 'TimelineStoryController@searchStory');

Route::get('latest', 'TimelineStoryController@getLatestStories');

Route::get('redis', 'TimelineStoryController@testRedis');

Route::get('opera', function(){

    return view('test')->with('is_opera', true);
});

Route::get('desktop', function(){
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    return $user_agent;
});

Route::post('linkout/{story_id}', 'TimelineStoryController@readStory');

//Handles the various category request
Route::get('{request_name}', 'TimelineStoryController@handleRequest');


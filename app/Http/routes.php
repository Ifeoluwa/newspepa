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

//Request that can come from a desktop source

// Handles the response of stories in Json format
Route::get('/stories_json','TimelineStoryController@getStoriesJson');

Route::get('test', 'FeedController@test');

Route::get('timeline', 'StoryController@createTimelineStory');

Route::get('redis', 'TimelineStoryController@testRedis');

Route::get('minor', function(){

    return view('test')->with('is_opera', true);
});

Route::get('desktop', function(){
//    $user_agent = $_SERVER['HTTP_USER_AGENT'];
//    return view('errors.desktopView');
});

Route::get('register', function(){
   return view('admin.register');
});

Route::get('publisher', function(){
    return view('major.publishersList');
});

Route::get('about', function(){
    return view('major.aboutUs');
});

//handles the home page request which displays the top stories/Timeline stories
//request that are expected to come from mobile phones
//Route::group(['middleware' => 'user_agent'], function() {

    Route::get('/', 'TimelineStoryController@index');

    Route::get('search', 'TimelineStoryController@searchStory');

    Route::get('latest', 'TimelineStoryController@getLatestStories');


    Route::post('linkout', 'TimelineStoryController@readStory');

    // Gets the request for the list of active publishers
    Route::get('publishers', 'TimelineStoryController@getPublishers');

    //Handles the various category request
    Route::get('{request_name}', 'TimelineStoryController@handleRequest');

//});


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
Route::get('hello', function(){
    return view('admin.new_post');
});
Route::get('timeline', 'StoryController@createTimelineStory');

Route::get('redis', 'TimelineStoryController@testRedis');

Route::get('desktop', function(){
//    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    return view('errors.desktopView');
});

Route::get('about', function(){
   return view('aboutUs');
});


Route::get('register', function(){
   return view('admin.register');
});


Route::group(['middleware' => 'auth'], function(){
    Route::get('admin/dashboard', 'Admin\DashboardController@getDashboard');

    Route::get('admin/story/new', 'Admin\DashboardController@newStory');
    Route::post('admin/story/create', 'StoryController@adminPost');
    Route::get('admin/story/actions', 'Admin\DashboardController@getStoryActions');
    Route::get('admin/story/edit/{story_id}', 'StoryController@editStory');
    Route::get('admin/story/delete/{story_id}', 'StoryController@deleteStory');
    Route::post('admin/story/update', 'StoryController@updateStory');
});

Route::get('admin', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');





//handles the home page request which displays the top stories/Timeline stories
//request that are expected to come from mobile phones
Route::group(['middleware' => 'user_agent'], function(){

    Route::get('/', 'TimelineStoryController@index');

    Route::get('search', 'TimelineStoryController@searchStory');

    Route::get('latest-news-in-nigeria', 'TimelineStoryController@getLatestStories');


    Route::get('linkout', 'TimelineStoryController@readStory');

    // Gets the request for the list of active publishers
    Route::get('publishers', 'TimelineStoryController@getPublishers');

    //Handles the various category request
    Route::get('{request_name}', 'TimelineStoryController@handleRequest');


});





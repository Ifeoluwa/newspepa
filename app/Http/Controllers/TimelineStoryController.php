<?php

namespace App\Http\Controllers;

use App\Category;
use App\Publisher;
use App\TimelineStory;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redis;

class TimelineStoryController extends Controller
{

    // Constructor
    public function __construct(){
        view()->share('makeStoryUrl');
    }

    public $category_names = array(1 => "Nigeria", 2 => "Politics", 3 => "Entertainment", 4 => "Sports", 5 => "Metro");


/**
* Display a listing of the timeline stories.
*
* @return Response
*/
    public function index()
    {
        //
        $timeline_stories = array();
        $timeline_stories['important'] = TimelineStory::importantStories();
        $timeline_stories['less_important'] = TimelineStory::lessImportantStories();
        $timeline_stories['no_image'] = TimelineStory::noImageStories();

//        Redis::get();
        return view('index')->with("data", array('timeline_stories' => $timeline_stories, 'publishers_name' => Publisher::$publishers));

    }

    /**
     * Returns the view for the category requested
     *
     * @return Response
     */
    public function getStoriesByCat($category_name){
        $category_stories = array();
        $category_id = Category::$news_category[$category_name];
        $category_stories['category_name'] = $this->category_names[$category_id];
        $category_stories['all'] = TimelineStory::recentStoriesByCat($category_id);

        return view('category')->with('data', array('category_stories' => $category_stories, 'publishers_name' => Publisher::$publishers));
    }


    public function getFullStory($story_id){
        $full_story = DB::table('timeline_stories')->where('story_id', $story_id)->get();
        return view('fullStory')->with('data', $full_story);
    }

    public function handleRequest($request_name){
        $request_array = explode('-', $request_name);
        if(count($request_array) > 1){
            var_dump($this->getFullStory($request_array[count($request_array) - 1])) ;
        }else{
            return $this->getStoriesByCat($request_name);
        }
    }

    public function makeStoryUrl($title, $id){
        $url = strtolower($title) ;

        $url = preg_replace("/[^a-z0-9_\s-]/", "", $url);
        //Clean up multiple dashes or whitespaces
        $url = preg_replace("/[\s-]+/", " ", $url);
        //Convert whitespaces and underscore to dash
        $url = preg_replace("/[\s_]/", "-", $url);
        return $url.'-'.($id);
    }

    public function getTimeDifference($start_date){
        $date1 = new \DateTime(strtotime($start_date));
        $date2 = new \DateTime();
        $diff = $date1->diff($date2);
        return $diff->format('%a Day and %h hours');
    }





}

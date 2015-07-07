<?php

namespace App\Http\Controllers;

use App\Category;
use App\Publisher;
use App\Story;
use App\TimelineStory;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TimelineStoryController extends Controller
{

    // Constructor
    public function __construct(){
//        view()->share('makeStoryUrl');
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
        $timeline_stories['top_stories'] = TimelineStory::topStories();
//        $timeline_stories['important'] = TimelineStory::importantStories();
//
//        $timeline_stories['less_important'] = array();
//
//        for($i = 1; $i <= count($this->category_names); $i++){
//            $timeline_stories['less_important'] = array_merge($timeline_stories['less_important'], TimelineStory::timelineStoriesByCat($i));
//        }
//
//
//        $timeline_stories['no_image'] = TimelineStory::noImageStories();

        return view('index')->with("data", array('timeline_stories' => $timeline_stories, 'publishers_name' => Publisher::$publishers, 'category_name' => $this->category_names));

    }

    /**
     * Returns the view for the category requested
     *
     * @return Response
     */
    public function getStoriesByCat($category_name){
        try{
            $category_stories = array();
            $category_id = Category::$news_category[$category_name];
            $category_stories['category_name'] = $this->category_names[$category_id];
            $category_stories['all'] = TimelineStory::recentStoriesByCat($category_id);

            return view('category')->with('data', array('category_stories' => $category_stories, 'publishers_name' => Publisher::$publishers));
        }catch(\ErrorException $ex){
            return view('errors.404', [], 404);
        }
    }


    //Gets all the details of the full story and the related stories
    public function getFullStory($story_id){
        $full_story = array();
        DB::table('timeline_stories')->where('story_id', $story_id)->increment('no_of_reads');
        $full_story['full_story'] = DB::table('timeline_stories')->where('story_id', $story_id)->get();
        $full_story['other_sources'] = Story::matches($story_id);
        $full_story['recent_stories'] = TimelineStory::recentStoriesByCatX($full_story['full_story'][0]['category_id'], $story_id);

        $full_story['category_names'] = $this->category_names;
        $full_story['publisher_names'] = Publisher::$publishers;
        return view('fullStory')->with('data', $full_story);
    }

    //Handles timeline request
    public function handleRequest($request_name){
        try{
            $request_array = explode('-', $request_name);
            if(count($request_array) > 1){
                return $this->getFullStory($request_array[count($request_array) - 1]) ;
            }else{
                return $this->getStoriesByCat($request_name);

            }
        }catch (\ErrorException $ex){
           return view('errors.404', [], 404);
        } catch (NotFoundHttpException $nfe){
            return view('errors.404', [], 404);
        }

    }

//    Creates the full story url
    public function makeStoryUrl($title, $id){
        $url = strtolower($title) ;

        $url = preg_replace("/[^a-z0-9_\s-]/", "", $url);
        //Clean up multiple dashes or whitespaces
        $url = preg_replace("/[\s-]+/", " ", $url);
        //Convert whitespaces and underscore to dash
        $url = preg_replace("/[\s_]/", "-", $url);
        return $url.'-'.($id);
//        return $this->getFullStory($id);
    }

    // Gets the time difference between the time a story is created and the current time
    public function getTimeDifference($start_date){
        date_default_timezone_set('Africa/Lagos');
        $date1 = new \DateTime($start_date);
        $date2 = new \DateTime();
        $diff = $date1->diff($date2);
        if ($diff->d){
            if($diff->d == 1){
                return $diff->format('%d day');
            }else{
                return $diff->format('%d days');
            }
        }else if($diff->h){
            if($diff->h == 1){
                return $diff->format('%h hour');
            }else{
                return $diff->format('%h hours');
            }
        }else if($diff->m){
            if($diff->m == 1){
                return $diff->format('%m min');
            }else{
                return $diff->format('%m mins');
            }
        }else {
            if($diff->s == 1){
                return $diff->format('%s second');
            }else{
                return $diff->format('%s seconds');
            }
        }

    }

    //Checks if the story is an old story
    public function isOldStory($created_date){
        $date = new \DateTime($created_date);
        $date_in_seconds = $date->getTimestamp();
        $diff = time() - $date_in_seconds;
        return ($diff > 43200);

    }

    public function searchStory(){

    }



}

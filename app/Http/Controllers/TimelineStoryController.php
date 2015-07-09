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
        $timeline_stories['top_stories'] = TimelineStory::topStories()->simplePaginate(20);

        return view('index')->with("data", array('timeline_stories' => $timeline_stories, 'publishers_name' => Publisher::$publishers, 'category_name' => $this->category_names));

    }

    //returns paginated stories in json format
    public function getStoriesJson(){

        return TimelineStory::topStories()->paginate();
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
        $diff_in_sec = $date2->getTimestamp() - $date1->getTimestamp();

        if ($diff_in_sec <= 60){
            return "Just now";
        }elseif($diff_in_sec > 60 && $diff_in_sec < 3600){
            if(intval($diff_in_sec/60) == 1){
                return "1 min";
            }else{
                return intval($diff_in_sec/60) ." mins";
            }
        }elseif($diff_in_sec > 3600 && $diff_in_sec < 86400){
            if(intval($diff_in_sec/3600) == 1){
                return "1 hr";
            }else{
                return intval($diff_in_sec/3600) ." hrs";
            }
        }elseif($diff_in_sec > 86400 && $diff_in_sec < 604800){
            if(intval($diff_in_sec/86400) == 1){
                return "1 day";
            }else{
                return intval($diff_in_sec/86400) ." days";
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

    public function createImage()
    {
        ob_start();
        imagecreatefromjpeg("story_images/277026_thumb.jpg");
        $fp = fopen("story_images/new_image", "w");
        $image_content = ob_get_contents();
        fwrite($fp, $image_content);
        fclose($fp);

    }


}

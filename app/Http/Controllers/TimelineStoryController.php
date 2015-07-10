<?php

namespace App\Http\Controllers;

use App\Category;
use App\Publisher;
use App\Story;
use App\TimelineStory;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Solarium\Core\Client\Adapter;
use Solarium\Core\Client;

class TimelineStoryController extends Controller
{

    protected $client;
    // Constructor
    public function __construct(){
//        $config = array(
//            'host'      => '192.190.86.123',
//            'port'      => 8080,
//            'path'      => '/solr',
//        );

        $this->client = new \Solarium\Client;
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
        $timeline_stories['top_stories'] = TimelineStory::topStories()->simplePaginate(50);

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

        //the php code for insert for jide to put in the cron
//        $stories_array = array();
//        //adding document to solr
//        $updateQuery = $this->client->createUpdate();
//
//        $story1 = $updateQuery->createDocument();
//        $story1->id = ''; //return the id of the insert from PDO query and attach it here
//        $story1->title_en = '';
//        $story1->description_en = '';
//        $story1->image_url_t = '';
//        $story1->video_url_t = '';
//        $story1->url = '';
//        $story1->pub_id_i = '';
//        $story1->has_cluster_i = '';
//        //do this for all stories and keep adding them to the stories array
//        //when done continue to the nest line
//
//        array_push($stories_array, $story1);
//
//        $updateQuery->addDocuments($stories_array);
//        $updateQuery->addCommit();
//
//        $result = $this->client->update($updateQuery);
        /*
         * end of add
         */

        /*
         * search
         */
        $search_query = \Illuminate\Support\Facades\Input::get('search_query');

        $query = $this->client->createSelect();
        $query->setQuery($search_query);
        $dismax = $query->getDisMax();
        $dismax->setQueryFields('title_en^3 description_en^3');
        $query->addSort('score',$query::SORT_DESC);
        $resultSet = $this->client->select($query);

        $search_result = array();
        foreach($resultSet as $doc)
        {
            $arr = array();
            $arr['id'] = $doc->id;
            $arr['title'] = $doc->title_en;
            $arr['description'] = $doc->description_en;
            $arr['image_url'] = $doc->image_url_t;
            $arr['video_url'] = $doc->video_url_t;
            $arr['url'] = $doc->url;
            $arr['pub_id'] = $doc->pub_id_i;
            $arr['has_cluster'] = $doc->has_cluster_i;

            array_push($search_result, $arr);
        }

        $found = $resultSet->getNumFound();

        $return = array(
            'search_result' => $search_result,
            'found' => $found
        );
        return view('search_results')->with('data', $return);
//        var_dump($return);
//        die();
//        return $return;
    }

    /*
     * auto suggest function
     */
    public function suggest($search_query){
        $suggestqry = $this->client->createSuggester();
        $suggestqry->setHandler('suggest');
        $suggestqry->setDictionary('suggest');

        $suggestqry->setQuery($search_query);
        $suggestqry->setCount(10);
        $suggestqry->setCollate(true);
        $suggestqry->setOnlyMorePopular(true);

        $resultset = $this->client->suggester($suggestqry);
        $suggested = array();
        foreach ($resultset as $term => $termResult) {
            foreach($termResult as $result){
                array_push($suggested, $result);
            }
        }
        return $suggested;
    }
}

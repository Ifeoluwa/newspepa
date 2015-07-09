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
use Solarium\Autoloader;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TimelineStoryController extends Controller
{

    protected $client;
    // Constructor
    public function __construct(){
//        $this->client = new \Solarium\Client(Config::get('solr'));
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

    public function searchStory($search_query){

        //the php code for insert for jide to put in the cron
        $stories_array = array();
        //adding document to solr
        $updateQuery = $this->client->createUpdate();

        $story1 = $updateQuery->createDocument();
        $story1->id = ''; //return the id of the insert from PDO query and attach it here
        $story1->title_en = '';
        $story1->description_en = '';
        $story1->image_url_t = '';
        $story1->video_url_t = '';
        $story1->url = '';
        $story1->pub_id_i = '';
        $story1->has_cluster_i = '';
        //do this for all stories and keep adding them to the stories array
        //when done continue to the nest line

        array_push($stories_array, $story1);

        $updateQuery->addDocuments($stories_array);
        $updateQuery->addCommit();

        $result = $this->client->update($updateQuery);
        /*
         * end of add
         */

        /*
         * search
         */

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
        return $return;
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

<?php

namespace App\Http\Controllers;

use App\Category;
use App\Publisher;
use App\Story;
use App\TimelineStory;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Solarium\Core\Client\Adapter;
use Solarium\Core\Client;

class TimelineStoryController extends Controller
{

    protected $client;
    protected $stop_word_array = array();
    protected $key_word_array = array();
    public $opera_checker;
    protected $feed_contoller;
    // Constructor
    public function __construct(){

        $this->client = new \Solarium\Client;
        $this->feed_contoller = new FeedController();
//        $stop_words = file_get_contents("/home/newspep/newspepa/public/scripts/stop_words.txt");
//        $key_words = file_get_contents("/home/newspep/newspepa/public/scripts/key_words.txt");
        $stop_words = ("");
        $key_words = ("");

        $this->stop_word_array = explode(PHP_EOL, $stop_words);
        $this->key_word_array = explode(PHP_EOL, $key_words);
    }

    public $category_names = array(1 => "Nigeria", 2 => "Politics", 3 => "Entertainment", 4 => "Sports", 5 => "Metro");


/**
* Display a listing of the timeline stories.
*
* @return Response
*/
    public function index()
    {

        $pageStart = \Request::get('page', 1);
        $perPage = 50;
        $offSet = ($pageStart * $perPage) - $perPage;

        $items = TimelineStory::timeLineStories();

        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);
        $timeline_stories['top_stories'] = new Paginator($itemsForCurrentPage, $perPage, Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
        $timeline_stories['top_stories']->setPath('/');

        //Handles the next and previous for the pagination on the view
        $paginator = new Paginator($items, 50);
        $paginator->setPath('/');

        if($this->isOpera()){
            return view('minor.index')->with("data", array('timeline_stories' => $timeline_stories, 'publishers_name' => Publisher::$publishers, 'category_name' => $this->category_names, 'paginator' => $paginator));

        }else{
            return view('major.index')->with("data", array('timeline_stories' => $timeline_stories, 'publishers_name' => Publisher::$publishers, 'category_name' => $this->category_names, 'paginator' => $paginator));

        }

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

            $pageStart = \Request::get('page', 1);
            $perPage = 50;
            $offSet = ($pageStart * $perPage) - $perPage;

            $items = TimelineStory::recentStoriesByCat($category_id);

            // Get only the items you need using array_slice
            $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

            $category_stories['all'] = new Paginator($itemsForCurrentPage, $perPage, Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
            $category_stories['all']->setPath($category_name);

            //Handles the next and previous for the pagination on the view
            $paginator = new Paginator($items, 50);
            $paginator->setPath($category_name);

            if($this->isOpera()){
                return view('minor.category')->with('data', array('category_stories' => $category_stories, 'publishers_name' => Publisher::$publishers, 'paginator' => $paginator));

            }else{
                return view('major.category')->with('data', array('category_stories' => $category_stories, 'publishers_name' => Publisher::$publishers, 'paginator' => $paginator));
            }
        }catch(\ErrorException $ex){
            return view('errors.404');
        }
    }

    //Gets story by publisher
    public function getStoriesByPublisher($publisher_name){

        try{


        }catch(\ErrorException $ex){
            return view('errors.404');
        }


    }

    //Latest Stories
    public function getLatestStories(){

        $nigeria = TimelineStory::recentStoriesByCat(1);
        $politics = TimelineStory::recentStoriesByCat(2);
        $entertainment = TimelineStory::recentStoriesByCat(3);
        $sports = TimelineStory::recentStoriesByCat(4);
        $metro = TimelineStory::recentStoriesByCat(5);

        $items = array_merge($nigeria, $politics, $entertainment, $sports, $metro);

        $pageStart = \Request::get('page', 1);
        $perPage = 50;
        $offSet = ($pageStart * $perPage) - $perPage;

        // Displays the next and previous on the view
        $paginator = new Paginator($items, 50);
        $paginator->setPath('latest');

        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

        // Initialize paginator class
        $latest_stories = new Paginator($itemsForCurrentPage, $perPage, Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
        $latest_stories->setPath('latest');

        if($this->isOpera()){
            return view('minor.latestStory')->with('data', array('latest_stories' => $latest_stories,  'publishers_name' => Publisher::$publishers, 'category_name' => $this->category_names, 'paginator' => $paginator));
        }else{
            return view('major.latestStory')->with('data', array('latest_stories' => $latest_stories,  'publishers_name' => Publisher::$publishers, 'category_name' => $this->category_names, 'paginator' => $paginator));
        }

    }


    //Gets all the details of the full story and the related stories
    public function getFullStory($story_id){

        $full_story = array();
        //Please do not change the story_id to id.
        $full_story['full_story'] = DB::table('timeline_stories')->where('story_id', $story_id)->get();

        $full_story['other_sources'] = Story::matches($story_id);

        $full_story['recent_stories'] = TimelineStory::recentStoriesByCatX($full_story['full_story'][0]['category_id'], $story_id);
        $full_story['category_names'] = $this->category_names;
        $full_story['publisher_names'] = Publisher::$publishers;
        $timezone = new \DateTimeZone('Africa/Lagos');

        $now = new \DateTime('now', $timezone);
        TimelineStory::updateStoryViews($story_id, $now);
        if($this->isOpera()){
            return view('minor.fullStory')->with('data', $full_story);

        }else{
            return view('major.fullStory')->with('data', $full_story);

        }

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
           return view('errors.404');
        } catch (NotFoundHttpException $nfe){
            return view('errors.404');
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
                return "1 min ago";
            }else{
                return intval($diff_in_sec/60) ." mins ago";
            }
        }elseif($diff_in_sec > 3600 && $diff_in_sec < 86400){
            if(intval($diff_in_sec/3600) == 1){
                return "1 hr ago";
            }else{
                return intval($diff_in_sec/3600) ." hrs ago";
            }
        }elseif($diff_in_sec > 86400 && $diff_in_sec < 604800){
            if(intval($diff_in_sec/86400) == 1){
                return "1 day ago";
            }else{
                return intval($diff_in_sec/86400) ." days ago";
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

        set_time_limit(0);
        /*
         * search
         */
        $search_query = \Illuminate\Support\Facades\Input::get('search_query');

        $search_query_array = explode(' ', $search_query);
        $search_query_array = array_diff($search_query_array, $this->stop_word_array);

        $search_query = implode(" ", $search_query_array);

        $query = $this->client->createSelect();
        $query->setQuery($search_query);
        $dismax = $query->getDisMax();
        $dismax->setQueryFields('title_en^3 description_en^3');
        $query->addSort('score',$query::SORT_DESC);
        $resultSet = $this->client->select($query);

        $search_result = array();
        $z = 0;
        foreach($resultSet as $doc)
        {
//            $title1 = mb_convert_encoding($doc->title_en[0], "UTF-8", "Windows-1252");
//            $title1 = html_entity_decode($title, ENT_QUOTES, "UTF-8");
            $j = 0;
            for($i = 0; $i < count($search_query_array); ++$i) {
                if (strpos(strtolower($doc->title_en[0]), strtolower($search_query_array[$i])) !== false) {
                    $j = $j + 1;
                }
            }
            if ($j >= (count($search_query_array) - 2)){

                $arr = array();
                $arr['story_id'] = $doc->id;
                $arr['title'] = $doc->title_en[0];
                $arr['description'] = $doc->description_en;
                $arr['image_url'] = $doc->image_url_t;
                $arr['video_url'] = $doc->video_url_t;
                $arr['url'] = $doc->url;
                $arr['pub_id'] = $doc->pub_id_i;
                $arr['has_cluster'] = $doc->has_cluster_i;

                array_push($search_result, $arr);
                $z = $z + 1;
            }
        }

//        $found = $resultSet->getNumFound();
        $found = $z;
        $return = array(
            'search_query' => $search_query,
            'search_result' => $search_result,
            'found' => $found,
            'publisher_names' => Publisher::$publishers
        );

        $pageStart = \Request::get('page', 1);
        $perPage = 5;
        $offSet = ($pageStart * $perPage) - $perPage;


        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($return['search_result'], $offSet, $perPage, true);
        $return['search_result'] = new Paginator($itemsForCurrentPage, $perPage, Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
        $return->setPath('search/results');

        // Displays the next and previous on the view
        $return['paginator'] = new Paginator($return['search_result'], 5);
        $return['paginator']->setPath('search/results');

        if($this->isOpera()){
            return view('minor.search_results')->with('data', $return);
        }else{
            return view('major.search_results')->with('data', $return);
        }

        set_time_limit(120);
//        var_dump($return);
//        die();

    }
    //Updates the linkout time and the number of linkouts when the user clicks on the continue to read option for each story
    public function readStory(){

        if(Request::ajax()){
            $data = Request::all();
            $story_id = $data['story_id'];
            $time = \Carbon\Carbon::now();
            $params = array(
                'story_id' => $story_id,
                'last_linkout_time' => date("Y-m-d H:i:s", $time)
            );


            DB::table('timeline_stories')->where('story_id', $story_id)->increment('link_outs');

            DB::update("UPDATE timeline_stories SET last_linkout_time = :last_linkout_time WHERE story_id = :story_id", $params);

            return "200";
//            $result = TimelineStory::updateStoryLinkOuts($story_id, \Carbon\Carbon::now());
//            return $result;
        }

    }

    public function testRedis(){
        Redis::set('name', 'Jide');
        return Redis::get('name');
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

    public function getStoryImage($url){
        $data = mb_convert_encoding(
                    file_get_contents($url),
                    "HTML-ENTITIES",
                    "UTF-8"
                );
        preg_match_all("/<meta([^>]+)\/>/i", $data, $match);

        foreach($match[0] as $value){
            if (strpos($value, "og:image") !== false){
                preg_match_all("/(content)=(\"|')*[^<>[:space:]]+[[:alnum:]#?\/&=+%_]/", $value, $match);
                $image = explode("=", $match[0][0]);
                $image_url = str_replace('"', '', $image[1]);
                if(strlen($image_url) < 60 || strpos(strtolower($image_url), "complete_sports_logo.jpg") !== false || strpos(strtolower($image_url), "breaking-news-red.png") !== false){
                    return null;
                }
                else{
                    return trim($image_url, '/');
                }
            }
        }
        return null;
    }

    public function test(){
        return $this->getStoryImage("Woman Tortured For Stealing Writes Police Commissioner");

    }

    private function isOpera(){
        $this->opera_checker = $_SERVER['HTTP_USER_AGENT'];

        return strpos(strtolower($this->opera_checker), "opera mini") !== false || strpos(strtolower($this->opera_checker), "opera mobi") !== false;
    }


    public function getPublishers(){
        $publishers = Publisher::where('status_id', 1)->get()->toArray();

        if($this->isOpera()){
            return view('minor.publishersList')->with('data', $publishers);
        }else{
            return view('major.publishersList')->with('data', $publishers);
        }
    }

    public function makeRoute($name){
        $route = strtolower($name) ;

        $route = preg_replace("/[^a-z0-9_\s-]/", "", $route);
        //Clean up multiple dashes or whitespaces
        $route = preg_replace("/[\s-]+/", " ", $route);
        //Convert whitespaces and underscore to dash
        $route = preg_replace("/[\s_]/", "-", $route);
        return $route;
    }


    public function paginate($items,$perPage)
    {
        $pageStart = \Request::get('page', 1);
        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage;

        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

        return new Paginator($itemsForCurrentPage, $perPage, $pageStart, array('path' => Paginator::resolveCurrentPath()));
    }


}

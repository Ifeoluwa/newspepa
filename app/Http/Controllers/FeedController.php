<?php
/**
 * Created by PhpStorm.
 * User: Babajide Owosakin
 * Date: 6/18/2015
 * Time: 10:40 AM
 */

namespace App\Http\Controllers;

//Handles all actions to be performed on feeds

use App\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Nathanmac\Utilities\Parser\Parser;
//use DB;

class FeedController extends Controller {

    // gets all the feed sources from the database
    private function getFeedSources(){

        $feeds = Feed::all()->toArray();
        return $feeds;
    }

    // handles the actual fetching of feeds from the feed sources
    public function fetchFeeds(){
        $feeds = FeedController::getFeedSources();
        $parser = new Parser();

        foreach($feeds as $feed){
//            Check if the feed is a valid xml
            if(FeedController::isFeedValid($feed['url'])){
                $date = new \DateTime($feed['last_access']);
                $int_interval = $date->getTimestamp() + ($feed['refresh_period'] * 60);
                //check if feed should be fetched based on last fetched time
                if ($int_interval < time()){
                    $content = FeedController::checkFeedSource($feed['url']);
                    if(!$content) {
                        continue;
                    }
                    $parsed = $parser->xml($content);

                    print_r($parsed);
                }

            }

        }

    }

    private function updateFeed(){

    }

    // Handles the vaidation of the file; checks if it is an xml file
    private function isFeedValid($feed_url){
        try{
            $raw_contents = file_get_contents($feed_url);
            // Checks if the content of the file begins the xml tag
            if (substr($raw_contents, 0, 5) === "<?xml"){
                return true;
            }
        }catch (\ErrorException $ex){

            return false;

        }
        return false;
    }


    // Checks feed source for contents
    private function checkFeedSource ($url){
        $init_curl = curl_init($url);
        curl_setopt($init_curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($init_curl);
        curl_close($init_curl);
        return $response;
    }




} 
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
use App\RawStory;
use Nathanmac\Utilities\Parser\Parser;


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
                    $stories = $parser->xml($content);

                    foreach ($stories['channel']['item'] as $str){
                        $image_match = preg_match('/(<img[^>]+>)/i', $str['description'], $matches);

                        $raw_story = array();
                        if(count($matches) > 0){
                            $raw_story['image_url'] = $matches[0];
                        }
                        $raw_story['title'] = "".$str['title']."";
                        $raw_story['pub_id'] = $feed['pub_id'];
                        $raw_story['feed_id'] = $feed['id'];
                        $raw_story['description'] = "".FeedController::clean(strip_tags($str['description']))."";
                        $raw_story['content'] = "".FeedController::clean(strip_tags($str['description']))."";
                        $raw_story['url'] = "".$str['link']."";
                        $raw_story['pub_date'] = strtotime($str['pubDate']);
                        $raw_story['insert_date'] = time();


                        RawStory::insertIgnore($raw_story);
                    }
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


    private function clean($string){
        return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string);
    }




} 
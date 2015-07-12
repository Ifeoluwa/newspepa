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
use App\Http\Requests\Request;
use App\Story;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Nathanmac\Utilities\Parser\Parser;
use PhpSpec\Exception\Example\ErrorException;


class FeedController extends Controller {

    // gets all the feed sources from the database
    private function getFeedSources(){

        $feeds = DB::table('feeds')->where('status_id', 1)->get();
        return $feeds;
    }

    // handles the actual fetching of feeds from the feed sources
    public function fetchFeeds(){
        set_time_limit(0);
        $feeds = FeedController::getFeedSources();
        $parser = new Parser();
        $all_stories = array();
        foreach($feeds as $feed){
//            Check if the feed is a valid xml
            if(FeedController::isFeedValid($feed['url'])){
                    $content = $this->checkFeedSource($feed['url']);
                    if(!$content) {
                        continue;
                    }
                    if($feed['pub_id'] == 4 || $feed['pub_id'] == 5 || $feed['pub_id'] == 10){
                        $all_stories = array_merge($all_stories, $this->getFeedContent($feed));
                    }else{
                        $stories = $parser->xml($content);

                        try{
                            foreach ($stories['channel']['item'] as $str){
                                $story = array();
                                if($feed['pub_id'] == 13){
                                    $img_url = $str['enclosure']['@attributes']['url'];
                                    if($this->storeImage($img_url)){
                                        $story['image_url'] = "story_images/".$this->getImageName($img_url);
                                    }

                                }else if($feed['pub_id'] == 1){


                                }else{
                                    preg_match('/(<img[^>]+>)/i', $str['description'], $matches);
                                    if(count($matches) > 0){
                                        FeedController::storeImage($this->getImageUrl($matches[0]));
                                        $story['image_url'] = "story_images/".$this->getImageName($this->getImageUrl($matches[0]));
                                    }
                                }

                                $story['title'] = "".$str['title']."";
                                $story['pub_id'] = $feed['pub_id'];
                                $story['feed_id'] = $feed['id'];
                                $story['category_id'] = $feed['category_id'];
                                $story['description'] = "".$this->clean(strip_tags($str['description']))."";
                                $story['content'] = "".$this->clean(strip_tags($str['description']))."";
                                $story['url'] = "".$str['link']."";
                                $story['pub_date'] = date('Y-m-d h:i:s', strtotime($str['pubDate']));

                                // Inserts the story into an array
                                array_push($all_stories, $story);

                            }
                        }catch (\ErrorException $ex){

                        }
                    }

            }
            //Updates the last time the feed was accessed
            Feed::updateFeed($feed['id'], time());

        }

        // Shuffle the array of stories
        shuffle($all_stories);
        foreach($all_stories as $story){
            Story::insertIgnore($story);
        }

        set_time_limit(120);

    }

    // This method get feeds from feeds with different organisation of content such as Nigerian Monitor, Stargist, and Koko Feed
    public function getFeedContent($feed){
        $rss = new \DOMDocument();
        $rss->load($feed['url']);
        $stories = array();
        foreach ($rss->getElementsByTagName('item') as $node) {
            $story = array (
                'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                'url' => $node->getElementsByTagName('link')->item(0)->nodeValue,
                'pub_date' => date('Y-m-d h:i:s', strtotime($node->getElementsByTagName('pubDate')->item(0)->nodeValue)),
                'description' => $this->clean(strip_tags($node->getElementsByTagName('description')->item(0)->nodeValue))."",
                'content' => $node->getElementsByTagName('encoded')->item(0)->nodeValue,

            );
            preg_match('/(<img[^>]+>)/i', $story['content'], $matches);
            if(count($matches) > 0){
                $this->storeImage($this->getImageUrl($matches[0]));
                $story['image_url'] = "story_images/".$this->getImageName($this->getImageUrl($matches[0]));
            }

            $story['feed_id'] = $feed['id'];
            $story['pub_id'] = $feed['pub_id'];
            $story['category_id'] = $feed['category_id'];
            array_push($stories, $story);
        }
        return $stories;

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
        $response = file_get_contents($url);
//        $init_curl = curl_init($url);
//        curl_setopt($init_curl, CURLOPT_RETURNTRANSFER, true);
//        $response = curl_exec($init_curl);
//        curl_close($init_curl);
        return $response;
    }


    // removes some unwanted characters
    private function clean($string){
        return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string);
    }


//    Gets the image URL from the html img tag
    public function getImageUrl($html){
        try{
            $doc = new \DOMDocument();
            $doc->loadHTML("".$html);
            $tag = $doc->getElementsByTagName("img");

            $image_url = $tag->item(0)->getAttribute("src");
            return $image_url;
        }catch (\ErrorException $ex){
            return "error::GetImageUrlError"."<br>";
        }

    }

    // Stores story images on local server
    public function storeImage($image_url){
        try {
            $image_content = file_get_contents($image_url);
            $fp = fopen("/home/newspep/newspepa/public/story_images/".$this->getImageName($image_url), "w");
            fwrite($fp, $image_content);
            fclose($fp);
            return true;
        }catch(\ErrorException $ex){
            return false;
        }

    }

    // Gets image name from the url
    public  function getImageName($image_url){
        $a = explode("/", $image_url);
        $image_name = $a[count($a) - 1];
        return $image_name;
    }

    public function test(){
        $this->fetchFeeds();
        echo "<br> done";

    }






} 
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
use Solarium\Core\Client\Adapter;
use Solarium\Core\Client;


class FeedController extends Controller {

    protected $client;
    // gets all the feed sources from the database
    private function getFeedSources(){

        $feeds = DB::table('feeds')->where('status_id', 1)->get();
        return $feeds;
    }

    // handles the actual fetching of feeds from the feed sources
    public function fetchFeeds(){
        set_time_limit(0);

        //solr
        $this->client = new \Solarium\Client;

        $feeds = FeedController::getFeedSources();
        $parser = new Parser();
        $all_stories = array();
        foreach($feeds as $feed){
//            Check if the feed is a valid xml
            //if(FeedController::isFeedValid($feed['url'])){
            $content = $this->checkFeedSource($feed['url']);
            if(!$content) {
                continue;
            }
            if($feed['pub_id'] == 4 || $feed['pub_id'] == 5 || $feed['pub_id'] == 10 || $feed['pub_id'] == 16 || $feed['pub_id'] == 19){
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
                            $tc = new TimelineStoryController();
                            $result = $tc->getStoryImage($str['title']);
                            if(count($result['search_result']) > 0){
                                $story['image_url'] = $result['search_result'][0]['url'].$result['search_result'][0]['name'];
                            }

                        }else{
                            preg_match('/(<img[^>]+>)/i', $str['description'], $matches);
                            if(count($matches) > 0){
                                if($this->storeImage($this->getImageUrl($matches[0]))){
                                    $story['image_url'] = "story_images/".$this->getImageName($this->getImageUrl($matches[0]));
                                }

                            }else{
                                $tc = new TimelineStoryController();
                                $result = $tc->getStoryImage($str['title']);
                                if(count($result['search_result']) > 0){
                                    $story['image_url'] = $result['search_result'][0]['url'].$result['search_result'][0]['name'];
                                }

                            }
                        }

                        $story['title'] = "".$str['title']."";
                        $story['pub_id'] = $feed['pub_id'];
                        $story['feed_id'] = $feed['id'];
                        $story['category_id'] = $feed['category_id'];
                        $story['description'] = "".strip_tags($str['description'])."";
                        $story['content'] = "".strip_tags($str['description'])."";
                        $story['url'] = "".$str['link']."";
                        $story['pub_date'] = date('Y-m-d h:i:s', strtotime($str['pubDate']));

                        // Inserts the story into an array
                        array_push($all_stories, $story);

                    }
                }catch (\ErrorException $ex){
                    continue;
                }
            }

           // }
            //Updates the last time the feed was accessed
            Feed::updateFeed($feed['id'], time());

        }

        // Shuffle the array of stories
        shuffle($all_stories);
        $stories_array = array();
        $fetched_stories = count($all_stories);
        $k = 0;
        foreach($all_stories as $story){
            $result = Story::insertIgnore($story);

            if($result !== false){
                //solr insert
                //adding document to solr
                $updateQuery = $this->client->createUpdate();

                $story1 = $updateQuery->createDocument();
                $story1->id = $result; //return the id of the insert from PDO query and attach it here
                $story1->title_en = $story['title'];
                $story1->description_en = $story['description'];
                $story1->image_url_t = $story['image_url'];
                $story1->video_url_t = $story['video_url'];
                $story1->url = $story['url'];
                $story1->pub_id_i = $story['pub_id'];
                $story1->has_cluster_i = '';
                //do this for all stories and keep adding them to the stories array
                //when done continue to the nest line
                array_push($stories_array, $story1);
            }

            if(!$this->isSimilarToPrevious($story)){
                $result = Story::insertIgnore($story);
                if($result !== false){
                    $k += 1;
                    $now  = date('Y-m-d h:i:s');
                    $fp = fopen("/home/newspep/newspepa/public/log.txt", "a");
                    fwrite($fp, $now." SUCCESS stories = ".$story['title']." Result = ".$result.PHP_EOL);
                    fclose($fp);
                }else{
                    $now  = date('Y-m-d h:i:s');
                    $fp = fopen("/home/newspep/newspepa/public/log.txt", "a");
                    fwrite($fp, $now." FAILED stories = ".$story['title']." Result = ".$result.PHP_EOL);
                    fclose($fp);
                }
            }
        }
        $updateQuery->addDocuments($stories_array);
        $updateQuery->addCommit();

        $result = $this->client->update($updateQuery);

        $stored_stories = $k;
        $now  = date('Y-m-d h:i:s');
        $fp = fopen("/home/newspep/newspepa/public/log.txt", "w");
        fwrite($fp, $now."fetch stories = ".$fetched_stories." stored stories = ".$stored_stories);
        fclose($fp);


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
                'description' => strip_tags($node->getElementsByTagName('description')->item(0)->nodeValue)."",
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
    private function checkFeedSource ($feed_url){

        try{
            $response = file_get_contents($feed_url);
            // Checks if the content of the file begins the xml tag
            if (substr($response, 0, 5) === "<?xml"){
                return $response;
            }
        }catch (\ErrorException $ex){

            return false;

        }
        return false;
//        $init_curl = curl_init($url);
//        curl_setopt($init_curl, CURLOPT_RETURNTRANSFER, true);
//        $response = curl_exec($init_curl);
//        curl_close($init_curl);
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
            $image_name = $this->getImageName($image_url);
            if($image_name == "App-logo.png" || $image_name == "METRO1-11.png"){
                return false;
            }else{
                $fp = fopen("/home/newspep/newspepa/public/story_images/".$this->getImageName($image_url), "w");
                fwrite($fp, $image_content);
                fclose($fp);
                return true;
            }

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

//        return $this->compareStrings("the boy is good", "the boy is goodies");

        $this->fetchFeeds();
        echo "<br> done";

    }

    // Function to compare the degree of similarity between two strings
    public function compareStrings($str_a, $str_b){
        $length = strlen($str_a);
        $length_b = strlen($str_b);

        $i = 0;
        $segmentcount = 0;
        $segmentsinfo = array();
        $segment = '';
        while ($i < $length)
        {
            $char = substr($str_a, $i, 1);
            if (strpos($str_b, $char) !== FALSE)
            {
                $segment = $segment.$char;
                if (strpos($str_b, $segment) !== FALSE)
                {
                    $segmentpos_a = $i - strlen($segment) + 1;
                    $segmentpos_b = strpos($str_b, $segment);
                    $positiondiff = abs($segmentpos_a - $segmentpos_b);
                    $posfactor = ($length - $positiondiff) / $length_b; // <-- ?
                    $lengthfactor = strlen($segment)/$length;
                    $segmentsinfo[$segmentcount] = array( 'segment' => $segment, 'score' => ($posfactor * $lengthfactor));
                }
                else
                {
                    $segment = '';
                    $i--;
                    $segmentcount++;
                }
            }
            else
            {
                $segment = '';
                $segmentcount++;
            }
            $i++;
        }

        // PHP 5.3 lambda in array_map
        $totalscore = array_sum(array_map(function($v) { return $v['score'];  }, $segmentsinfo));
        return $totalscore * 100;
    }

    //Checks if there's a similar existing story in the database
    public function isSimilarToPrevious($story){
        $isSimilar = false;
        $timezone = new \DateTimeZone('Africa/Lagos');
        $prev_stories = DB::table('stories')->where('feed_id', $story['feed_id'])
            ->whereBetween('created_date', [new \DateTime('-1hour'), new \DateTime('now')])->get();
        foreach($prev_stories as $prev_story){
            if($this->compareStrings($story['title'], $prev_story['title']) > 70){
                $isSimilar = $isSimilar || true;
            }else{
                $isSimilar = $isSimilar || false;
            }
        }

        return $isSimilar;
    }






} 
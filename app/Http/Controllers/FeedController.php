<?php
/**
 * Created by PhpStorm.
 * User: Babajide Owosakin
 * Date: 6/18/2015
 * Time: 10:40 AM
 */

namespace App\Http\Controllers;

//Handles all actions to be performed on feeds

use App\Cluster;
use App\Feed;
use App\Http\Requests\Request;
use App\Story;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Nathanmac\Utilities\Parser\Exceptions\ParserException;
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
    public function fetchFeeds()
    {
        set_time_limit(0);

        $feeds = FeedController::getFeedSources();

        $all_stories = array();
        foreach ($feeds as $feed) {
            $content = $this->checkFeedSource($feed['file_path']);
            if (!$content) {
                continue;
            }
            if($feed['pub_id'] == 5 || $feed['pub_id'] == 10 || $feed['pub_id'] == 16 || $feed['pub_id'] == 19 || $feed['pub_id'] == 21) {
                $all_stories = array_merge($all_stories, $this->getFeedContent($feed));
            }elseif ($feed['pub_id'] == 12) {
                $all_stories = array_merge($all_stories, $this->getBloggerFeeds($feed));
            }elseif($feed['pub_id'] == 27){
                $all_stories = array_merge($all_stories, $this->getBBCFeedContent($feed));
            }elseif($feed['pub_id'] == 4){
                $all_stories = array_merge($all_stories, $this->getFullFeedContent($feed));
            }else {
                try {
                    $all_stories = array_merge($all_stories, $this->getOtherFeeds($feed));
                } catch (ParserException $exp) {
                    echo $exp->getMessage();
                    continue;
                }
            }

            Feed::updateFeed($feed['id'], time());
            var_dump('<br>Fetched stories...');

        }

//        Inserts shuffled fetched stories
        $inserted_stories = $this->insertFetchedStories(shuffle($all_stories));

        //Begin Matching
        var_dump('Beginning matching>>> <br>');
        if (count($inserted_stories) > 0) {
            $new_stories = StoryController::prepareStories($inserted_stories);
            $old_stories = StoryController::getOldStories();
            $matched_stories = StoryController::matchStories($old_stories, $new_stories);

            Cluster::insertIgnore($matched_stories);
        }


            set_time_limit(120);

    }


    // Inserts fetched stories into the database
    public function insertFetchedStories($all_stories){
        $fetched_stories = count($all_stories);
        $k = 0;

        //Array for stories are succesfully inserted into the database
        $inserted_stories = array();
        foreach ($all_stories as $story) {
            $similarity = $this->isSimilarToPrevious($story);
            if ($similarity !== true) {
                $result = Story::insertIgnore($story);
                $date = new \DateTime('now');

                if ($result !== false) {
                    $story['id'] = $result;
                    array_push($inserted_stories, $story);

                    $k += 1;
                    $now = date('Y-m-d h:i:s');
                    $fp = fopen("/home/newspep/newspepa/public/log.txt", "a+");
                    fwrite($fp, $now . " SUCCESS stories = " . $story['title'] . " Result = " . $result . " FROM feed_id=" . $story['feed_id'] . PHP_EOL);
                    fclose($fp);
                } else {
                    $now = date('Y-m-d h:i:s');
                    $fp = fopen("/home/newspep/newspepa/public/log.txt", "a+");
                    fwrite($fp, $now . " FAILED stories = " . $story['title'] . " Result = " . $result . " FROM feed_id=" . $story['feed_id'] . PHP_EOL);
                    fclose($fp);
                }

            }

            $stored_stories = $k;
            $now = date('Y-m-d h:i:s');
            $fp = fopen("/home/newspep/newspepa/public/log.txt", "a+");
            fwrite($fp, $now . "fetch stories = " . $fetched_stories . " stored stories = " . $stored_stories . PHP_EOL);
            fclose($fp);

        }
        return $inserted_stories;
    }

    // This method get feeds from feeds with different organisation of content such as Nigerian Monitor, Stargist, and Koko Feed
    public function getFeedContent($feed){
        $rss = new \DOMDocument();
        $rss->load($feed['url']);
        $stories = array();
        foreach ($rss->getElementsByTagName('item') as $node) {
            try{
                $story = array (
                    'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                    'url' => $node->getElementsByTagName('link')->item(0)->nodeValue,
                    'pub_date' => date('Y-m-d h:i:s', strtotime($node->getElementsByTagName('pubDate')->item(0)->nodeValue)),
                    'description' => strip_tags($node->getElementsByTagName('description')->item(0)->nodeValue)."",
                    'content' => $node->getElementsByTagName('encoded')->item(0)->nodeValue,

                );
                preg_match('/(<img[^>]+>)/i', $story['content'], $matches);
                if(count($matches) > 0){
                    $this->storeImage($this->getImageUrl($matches[0]), $story['title'], $story['pub_date']);
                    $story['image_url'] = "story_images/".$this->getImageName($this->getImageUrl($matches[0]), $story['title'], $story['pub_date']);
                }

                $story['feed_id'] = $feed['id'];
                $story['pub_id'] = $feed['pub_id'];
                $story['category_id'] = $feed['category_id'];
                array_push($stories, $story);
            }catch(\ErrorException $ex){
                continue;
            }

        }
        return $stories;

    }

    public function getFullFeedContent($feed){
        $rss = new \DOMDocument();
        $rss->load($feed['url']);
        $stories = array();
        foreach ($rss->getElementsByTagName('item') as $node) {
            try{
                $story = array (
                    'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                    'url' => $node->getElementsByTagName('link')->item(0)->nodeValue,
                    'pub_date' => date('Y-m-d h:i:s', strtotime($node->getElementsByTagName('pubDate')->item(0)->nodeValue)),
                    'content' => $node->getElementsByTagName('encoded')->item(0)->nodeValue,

                );
                preg_match('/(<img[^>]+>)/i', $story['content'], $matches);
                if(count($matches) > 0){
                    $this->storeImage($this->getImageUrl($matches[0]), $story['title'], $story['pub_date']);
                    $story['image_url'] = "story_images/".$this->getImageName($this->getImageUrl($matches[0]), $story['title'], $story['pub_date']);
                }

                $story['feed_id'] = $feed['id'];
                $story['pub_id'] = $feed['pub_id'];
                $story['category_id'] = $feed['category_id'];

                //Crawls the site for all contents
                $html = file_get_contents($story['url']);

                $dom = new \DOMDocument();
                libxml_use_internal_errors(true);
                $dom->loadHTML($html);

                $xpath = new \DOMXPath($dom);
                //Gets the content within the div that contains the description of the story
                $div = $xpath->query('//div[@class="content-text"]');

                $div = $div->item(0);

                $description = $dom->saveXML($div);
                preg_match('/(<img[^>]+>)/i', $description, $matches);

                $description = str_replace($matches[0], "", $description);
                $description = strip_tags($description, '<p><a><div><img><br><iframe>');
//                $tidy = new \tidy();
//                $tidy->repairString($description);
                $story['description'] = $description;
                array_push($stories, $story);
            }catch(\ErrorException $ex){
                continue;
            }

        }
        return $stories;

    }

    public function getBBCFeedContent($feed)
    {
        $rss = new \DOMDocument();
        $rss->load($feed['url']);
        $stories = array();
        foreach ($rss->getElementsByTagName('entry') as $node) {
            try {
                $story = array(
                    'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                    'url' => $node->getElementsByTagName('link')->item(0)->getAttribute('href'),
                    'pub_date' => date('Y-m-d h:i:s', strtotime($node->getElementsByTagName('published')->item(0)->nodeValue)),
                    'description' => strip_tags($node->getElementsByTagName('summary')->item(0)->nodeValue) . "",

                );
                $story['feed_id'] = $feed['id'];
                $story['pub_id'] = $feed['pub_id'];
                $story['category_id'] = $feed['category_id'];
                $tc = new TimelineStoryController();
                $img_url = $tc->getStoryImage($story['url']);
                if($this->storeImage($img_url, $story['title'], $story['pub_date'])){
                    $story['image_url'] = "story_images/".$this->getImageName($img_url, $story['title'], $story['pub_date']);
                }
                array_push($stories, $story);
            } catch (\ErrorException $ex) {
                continue;
            }
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
    public function storeImage($image_url, $title, $pub_date){
        try {
            $image_content = file_get_contents($image_url);
            $image_name = $this->getImageName($image_url, $title, $pub_date);
            if($image_name == "App-logo.png" || $image_name == "METRO1-11.png" || $image_name == "ajax-loader.gif"){
                return false;
            }else{
                $fp = fopen("/home/newspep/newspepa/public/story_images/".$image_name, "w");
                fwrite($fp, $image_content);
                fclose($fp);
                return true;
            }

        }catch(\ErrorException $ex){
            return false;
        }

    }

    // Gets image name from the url
    public  function getImageName($image_url, $title, $pub_date){
        $a = explode("/", $image_url);
        $image_name = $a[count($a) - 1];
        if($image_name == "App-logo.png" || $image_name == "METRO1-11.png" || $image_name == "ajax-loader.gif"){
            return  $image_name;
        }else{

            return  strlen($title)."".strtotime($pub_date)."".$image_name;

        }
    }

    // Gets stories from blogger feeds e.g. Linda Ikeji
    public function getBloggerFeeds($feed){
        $rss = new \DOMDocument();
        $rss->load($feed['url']);
        $stories = array();
        foreach ($rss->getElementsByTagName('entry') as $node) {

            try{
                $story = array (
                    'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                    'url' => $node->getElementsByTagName('origLink')->item(0)->nodeValue,
                    'pub_date' => date('Y-m-d h:i:s', strtotime($node->getElementsByTagName('published')->item(0)->nodeValue)),
                    'description' => strip_tags($node->getElementsByTagName('content')->item(0)->nodeValue)."",
                    'content' => $node->getElementsByTagName('content')->item(0)->nodeValue,

                );
                preg_match('/(<img[^>]+>)/i', $story['content'], $matches);
                if(count($matches) > 0){
                    if($this->storeImage($this->getImageUrl($matches[0]), $story['title'], $story['pub_date'])){
                        $story['image_url'] = "story_images/".$this->getImageName($this->getImageUrl($matches[0]), $story['title'], $story['pub_date']);
                    }
                }

                $story['feed_id'] = $feed['id'];
                $story['pub_id'] = $feed['pub_id'];
                $story['category_id'] = $feed['category_id'];
                array_push($stories, $story);
            }catch(\ErrorException $ex){
                continue;
            }

        }
        return $stories;

    }

    public function test(){

        $html = '<div class="content-text">&#13;
&#13;
&#13;
&#13;
    <p></p>
<p>A lot of controversies are trailing the selection of the next Ooni Of Ife with a number of candidates stepping up to claim the title.</p>
<p>The Obadio Agbaye of Ile-Ife, the chief priest, Chief Olajide Farotimi Faloba, has given a bit of insight into how the next Ooni will emerge. He said,  “I am the Chief Priest and the king-maker to the Ooni stool because, I am the mouthpiece of the gods. So, if there should be coronation, I will be the one that will pronounce it.“</p>
<p>“There are 401 Yoruba deities and temples scattered worldwide, 201 of them are in Ife. Among these deities, the only speaking one is the legendary living Ooni.“”If it happens that an Ooni dies, there are sacrifices and signs that will be performed. Part of them is the closing of the palace main gate. Also, the messenger will go around the town with a gong to announce the demise, while the trees in the ancient town will be cut down, markets will remain shut to customers and the entire Ife city will be thrown into mourning.“</p>
<p>“There will not be any form of ceremony of burial while other traditional rites and rituals will take place as the oracle reveals.<br/>
”Also, if an Ooni dies, the 201 deities temples will be duly informed.”</p><div class="wpInsert wpInsertInPostAd wpInsertMiddle" style="margin: 5px; padding: 0px;"><div style="text-align: center; background:#F6F2F2; padding-top:7px;">&#13;
&#13;
<script async="" src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"/><!-- KokoFeed Sidebar2 --><ins class="adsbygoogle" style="display:inline-block;width:300px;height:250px" data-ad-client="ca-pub-2460597205856998" data-ad-slot="4063292047"/>&#13;
<script><![CDATA[
(adsbygoogle = window.adsbygoogle || []).push({});
]]></script>
</div>
</div>
<p>“On the selection processes of the next Ooni, the chief priest said the kingmakers would pick one person from all Ife Princes that show interest in the stool and Ifa oracle would be consulted on the choice before the final ratification by the chief priest.”</p>
<p><img class=" size-full wp-image-24941 aligncenter" src="http://kokofeed.com/wp-content/uploads/2015/08/ooni.jpg" alt="ooni" width="480" height="319"/></p>
<p>As it stands, there are four ruling houses that could be enthroned as the Ooni of Ife and they are: Osinkola, Ogboru, Lafogido and Giesi.</p>
<p>The chief priest stated that before being made known to the public, the new Ooni would be required to spend some days in Ile Oduduwa (Oduduwa’s house) which housed the first Ooni and other past Ooni with the priests when other rituals would be performed.</p>
<p>He explained, “When ever there is a demise of Ooni, the kingmaker and the Ifa Oracle will pick the next Ooni. 10 or 20 princes may contest after they might have been presented by their families, but the Ifa priest will consult the oracle that will choose while myself as the kingmaker will perform the necessary rituals that will certify him to mount the throne of Ooni; without this rituals, such potential monarch would not be Ooni,”</p>
&#13;
        <hr/><a class="fb-class" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://kokofeed.com/2015/08/20/an-in-depth-look-at-how-the-next-ooni-of-ife-will-be-selected/" data-layout="box_count"/>&#13;
&#13;
<hr/></div>';
        $description = strip_tags($html, '<p><a><div><img><br><iframe>');
        echo $description;
//        $tidy = new \tidy();
//        $tidy->repairString($description);
//        $description = tidy_repair_string($description);
//        echo $description;


//        $this->getFullFeedContent();
//        $this->fetchFeeds();
//        echo "<br> done";
////        $this->fetchFeeds();
//        echo "<br> done";

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
            ->whereBetween('created_date', [new \DateTime('-1hour', $timezone), new \DateTime('now', $timezone)])->get();
        foreach($prev_stories as $prev_story){
            if($this->compareStrings(strtolower($story['title']), strtolower($prev_story['title'])) > 70){
                $isSimilar = $isSimilar || true;
                break;
            }else{
                $isSimilar = $isSimilar || false;
            }
        }

        return $isSimilar;
    }


    public function getOtherFeeds($feed){
        $parser = new Parser();
        $all_stories = array();
        $content = $this->checkFeedSource($feed['url']);
        try{
            $stories = $parser->xml($content);
            if(!$content){
                return $all_stories;
            }else{
                try{
                    foreach ($stories['channel']['item'] as $str){
                        $story = array();
                        if($feed['pub_id'] == 13){
                            $img_url = $str['enclosure']['@attributes']['url'];
                            if($this->storeImage($img_url, $str['title'], $str['pubDate'])){
                                $story['image_url'] = "story_images/".$this->getImageName($img_url, $str['title'], $str['pubDate']);
                            }

                        }else if($feed['pub_id'] == 1 || $feed['pub_id'] == 22 || $feed['pub_id'] == 23 || $feed['pub_id'] == 25 || $feed['pub_id'] == 24 || $feed['pub_id'] == 26){
                            $tc = new TimelineStoryController();
                            $result = $tc->getStoryImage($str['link']);
                            if($result !== null){
                                $story['image_url'] = $result;
                            }

                        }else{
                            preg_match('/(<img[^>]+>)/i', $str['description'], $matches);
                            if(count($matches) > 0){
                                if($this->storeImage($this->getImageUrl($matches[0]), $str['title'], $str['pubDate'])){
                                    $story['image_url'] = "story_images/".$this->getImageName($this->getImageUrl($matches[0]), $str['title'], $str['pubDate']);
                                }

                            }else{
                                $tc = new TimelineStoryController();
                                $result = $tc->getStoryImage($str['link']);
                                if($result !== null){
                                    $story['image_url'] = $result;
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

                        // Inserts the story array into an other stories array
                        array_push($all_stories, $story);

                    }

                }catch (\ErrorException $ex){
                    echo $ex->getMessage();
                }
                return $all_stories;
            }

        }catch(ParserException $exp){
            echo $exp->getMessage();
        }
        return $all_stories;
    }








} 
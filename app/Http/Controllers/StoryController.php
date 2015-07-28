<?php
/**
 * Created by PhpStorm.
 * User: Babajide Owosakin
 * Date: 6/18/2015
 * Time: 5:35 PM
 */

namespace App\Http\Controllers;


use App\Story;
use App\TimelineStory;
use Illuminate\Support\Facades\DB;

class StoryController extends Controller {


    //handles the addition of story to the database
    public function addStory(){

    }

    public function createTimelineStory(){
        set_time_limit(0);
        // Stories to Timeline Stories

        DB::transaction(function(){
            $stories = DB::table('stories')->where('status_id', 1)->get();
            foreach($stories as $story){
                $story['story_url'] = $this->makeStoryUrl($story['title'], $story['id']);
                $story['story_id'] = $story['id'];
                $timeline_story = array_except($story, ['id']);
                TimelineStory::insertIgnore($timeline_story);
            }

        });

        // Cluster-Pivot Method
//        $pivots = Story::pivots();
//
//        foreach($pivots as $pivot){
//
//            $pivot['story_url'] = $this->makeStoryUrl($pivot['title'], $pivot['cluster_pivot']);
//            $pivot['story_id'] = $pivot['cluster_pivot'];
//            array_pull($pivot, 'cluster_pivot');
//            array_pull($pivot, 'cluster_match');
//
//
//            $pivot['is_pivot'] = 1;
//
//            TimelineStory::insertIgnore($pivot);
//            $matches = Story::matches($pivot['story_id']);
//
//            foreach($matches as $match){
//
//                $match['story_url'] = $this->makeStoryUrl($match['title'], $match['cluster_match']);
//                $match['story_id'] = $match['cluster_match'];
//                array_pull($match, 'cluster_pivot');
//                array_pull($match, 'cluster_match');
//
//                TimelineStory::insertIgnore($match);
//            }
//
//        }

        set_time_limit(120);

    }

    //
    public function newCreateTimeLineStories(){
        DB::transaction(function(){
            $stories = Story::pivots();
            foreach($stories as $story){
                $story['story_url'] = $this->makeStoryUrl($story['title'], $story['id']);
                $story['story_id'] = $story['id'];
                $timeline_story = array_except($story, ['id']);
                TimelineStory::insertIgnore($timeline_story);
            }

        });
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
    }

    public static function getOldStories(){
        $stories = DB::table('clusters')
            ->join('stories', 'clusters.cluster_match',  '=',  'stories.id')
            ->where('created_date', [new \DateTime('-1day'), new \DateTime('now')])->get();
        return StoryController::prepareStories($stories);
    }

    public static function prepareStories($stories){
        $clean_stories = array();
        foreach($stories as $story){
            $title = mb_convert_encoding($story['title'], "UTF-8", "Windows-1252");
            $story['title'] = html_entity_decode($title, ENT_QUOTES, "UTF-8");

            $story['title'] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $story['title']);

            //$desc = mb_convert_encoding($story['description'], "UTF-8", "Windows-1252");
            //$story['description'] = html_entity_decode($desc, ENT_QUOTES, "UTF-8");

            //$story['description'] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $data['description']);

            array_push($clean_stories, $story);
        }
        return $clean_stories;
    }

    public static function matchStories($old_stories, $new_stories){
        // Execute the python script with the JSON data
        $result = shell_exec('python /var/www/first_py/test.py ' . escapeshellarg(json_encode($data)));
        return json_decode($result);
    }


    public function adminPost($post_details){
        $post_details = \Illuminate\Support\Facades\Input::get('post_details');

        $post_details['pub_id'] = 21;
        $post_details['feed_id'] = 33;

        $result = Story::insertIgnore($post_details);
    }
} 
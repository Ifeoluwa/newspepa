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
        $pivots = Story::pivots();

        foreach($pivots as $pivot){

            $pivot['story_url'] = $this->makeStoryUrl($pivot['title'], $pivot['cluster_pivot']);
            $pivot['story_id'] = $pivot['cluster_pivot'];
            array_pull($pivot, 'cluster_pivot');
            array_pull($pivot, 'cluster_match');


            $pivot['is_pivot'] = 1;

            TimelineStory::insertIgnore($pivot);
            $matches = Story::matches($pivot['story_id']);

            foreach($matches as $match){

                $match['story_url'] = $this->makeStoryUrl($match['title'], $match['cluster_match']);
                $match['story_id'] = $match['cluster_match'];
                array_pull($match, 'cluster_pivot');
                array_pull($match, 'cluster_match');

                TimelineStory::insertIgnore($match);
            }

        }

        set_time_limit(120);

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







} 
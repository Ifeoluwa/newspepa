<?php
/**
 * Created by PhpStorm.
 * User: Babajide Owosakin
 * Date: 6/18/2015
 * Time: 5:35 PM
 */

namespace App\Http\Controllers;


use App\Story;
use Illuminate\Support\Facades\DB;

class StoryController extends Controller {


    //handles the addition of story to the database
    public function addStory(){

    }

    public function createTimelineStory(){

        $pivots = Story::pivots();

        foreach($pivots as $pivot){
            $matches = Story::matches($pivot['cluster_pivot']);
            $pivot['story_url'] = $this->makeStoryUrl($pivot['title'], $pivot['story_id']);
            Story::insertIgnore($pivot);
            foreach($matches as $match){
                $match['story_url'] = $this->makeStoryUrl($match['title'], $match['story_id']);
                Story::insertIgnore($match);
            }
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





} 
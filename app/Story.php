<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Story extends Model
{

    // Gets all the pivot stories
    public static function pivots(){

        $pivots = DB::table('clusters')->join('stories', 'clusters.cluster_pivot', '=', 'stories.id')->select('stories.*', 'clusters.*')->get();

        return $pivots;

    }

    // Gets all the stories that match the pivot story
    public static function matches($cluster_pivot){
        $matches = DB::table("clusters")->join('stories', 'stories.id', '=', 'match_id')
            ->select('stories.id as story_id, stories.title as title, stories.image_url, stories.video_url, stories.description as description, stories.content as content,
        stories.url as url, stories.pub_id as pub_id, stories.feed_id as feed_id, stories.category_id as category_id,
        stories.status_id as status_id, stories.pub_date as pub_date, stories.has_cluster as has_cluster')->where('clusters.cluster_pivot', $cluster_pivot)
            ->get();

        return $matches;
    }


    public static function insertIgnore($array){
        $a = new static();
        if($a->timestamps){
            $now = \Carbon\Carbon::now();
            $array['created_date'] = $now;
            $array['modified_date'] = $now;
        }

        DB::insert('INSERT IGNORE INTO timeline_stories ('.implode(',',array_keys($array)).
            ') values (?'.str_repeat(',?',count($array) - 1).')',array_values($array));

    }

}

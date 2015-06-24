<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{

    // Gets all the pivot stories
    public static function getPivots(){

        $pivots = DB::table('stories')->where('has_cluster', 1)->get();

        return $pivots;

    }

    // Gets all the stories that match the pivot story
    public static function getMatches($pivot_id){
        $matches = DB::table("clusters")->join('stories', 'stories.id', '=', 'match_id')->where('clusters.pivot_id', $pivot_id)
            ->get();

        return $matches;
    }
}

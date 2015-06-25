<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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


    public static function insertIgnore($array){
        $a = new static();
        if($a->timestamps){
            $now = \Carbon\Carbon::now();
            $array['created_date'] = $now;
            $array['modified_date'] = $now;
        }

        DB::insert('INSERT IGNORE INTO stories ('.implode(',',array_keys($array)).
            ') values (?'.str_repeat(',?',count($array) - 1).')',array_values($array));

    }

}

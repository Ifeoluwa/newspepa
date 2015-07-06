<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Story extends Model
{

    // Gets all the pivot stories
    public static function pivots(){

        $pivots = DB::table('clusters')->join('stories','clusters.cluster_pivot', '=', 'stories.id')->whereRaw('clusters.cluster_pivot = clusters.cluster_match')->get();


        return $pivots;

    }

    // Gets all the stories that match the pivot story
    public static function matches($cluster_pivot){
        $matches = DB::table("clusters")->join('stories', 'clusters.cluster_match',  '=',  'stories.id')->where('clusters.cluster_pivot', $cluster_pivot)
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

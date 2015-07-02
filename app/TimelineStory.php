<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TimelineStory extends Model
{
    //
    //Returns stories that are popular
    public function scopePopular($query){
        return $query->where('reads', '>', 100);
    }

    //timeline stories that are active
    public function scopeActive($query){
        return $query->where('status_id', 1);
    }

    //Gets the most important story based on the number of reads and link-outs
    public function scopeImportant($query){
        return $query->max('reads');
    }

    // Selects recent stories based on category
    public static function recentStoriesByCat($category_id){
        return DB::table('timeline_stories')->where('category_id', $category_id)->orderBy('created_date', 'desc')->limit(20)->get();
    }

    // Selects recent stories based on category but not the selected story
    public static function recentStoriesByCatX($category_id, $story_id){
        return DB::table('timeline_stories')->where('category_id', $category_id)->orderBy('created_date', 'desc')->whereNotIn('story_id', $story_id)->limit(10)->get();
    }

    // important stories metrics not stable yet
    public static function importantStories(){
        return DB::table('timeline_stories')->select(DB::raw('id, story_id, title, description, category_id, pub_id, pub_date, content, url, image_url, no_of_reads, created_date'))
            ->orderBy('created_date', 'desc')->orderBy('no_of_reads', 'desc')->where('status_id', 1)->limit(5)->get();
    }

//    Selects stories that have no images
    public static function noImageStories(){
        return DB::table('timeline_stories')->where('image_url', '')->orderBy('created_date', 'desc')->limit(10)->get();
    }

    // Metrics not stable yet
    public static function lessImportantStories(){
        return DB::table('timeline_stories')->limit(10)->orderBy('pub_date', 'desc')->orderBy('no_of_reads', 'desc')->get();
    }

    //Scope for the recent stories alone from all categories
    public function scopeRecent($query){
        return $query->orderBy('created_date', 'desc')->limit(5);
    }

    //Selects the timeline stories based on the number of
    public static function timelineStoriesByCat($category_id){
        return DB::table('timeline_stories')->select(DB::raw('id, story_id, title, description, category_id, pub_id, pub_date, content, url, image_url, no_of_reads, created_date'))
            ->orderBy('created_date', 'desc')->where('status_id', 1)->where('category_id', $category_id)->limit(5)->get();
    }




}

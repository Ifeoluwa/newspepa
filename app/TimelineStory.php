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

    public static function recentStoriesByCat($category_id){
        return DB::table('timeline_stories')->where('category_id', $category_id)->orderBy('created_date', 'desc')->limit(20)->get();
    }

    public static function importantStories(){
        return DB::table('timeline_stories')->select(DB::raw('id, story_id, title, description, category_id, pub_id, pub_date, content, url, image_url, max(no_of_reads) as no_of_reads, created_date'))
            ->orderBy('created_date', 'desc')->where('status_id', 1)->get();
    }

    public static function noImageStories(){
        return DB::table('timeline_stories')->where('image_url', '')->orderBy('pub_date', 'desc')->limit(10)->get();
    }

    public static function lessImportantStories(){
        return DB::table('timeline_stories')->limit(10)->orderBy('pub_date', 'desc')->orderBy('no_of_reads', 'desc')->get();
    }

    public function scopeRecent($query){
        return $query->orderBy('created_date', 'desc')->limit(5);
    }




}

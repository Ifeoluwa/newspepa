<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TimelineStory extends Model
{

    private $timezone;

    public function __construct(){
        $this->timezone = new \DateTimeZone('Africa/Lagos');
    }

    public $top_stories = array();
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
        return DB::table('timeline_stories')->where('category_id', $category_id)->orderBy('created_date', 'desc')->limit(200)->get();
    }

    // Selects recent stories based on category but not the selected story
    public static function recentStoriesByCatX($category_id, $story_id){
        return DB::table('timeline_stories')->where('category_id', $category_id)->orderBy('created_date', 'desc')->whereNotIn('story_id', [$story_id])->limit(10)->get();
    }

    // important stories metrics not stable yet
    public static function importantStories(){
        return DB::table('timeline_stories')->select(DB::raw('id, story_id, title, description, category_id, pub_id, pub_date, content, url, image_url, no_of_reads, created_date'))
            ->orderBy('created_date', 'desc')->orderBy('no_of_reads', 'desc')->where('image_url', '<>', '')->limit(10)->get();
    }

//    Selects stories that have no images
    public static function noImageStories(){
        return DB::table('timeline_stories')->where('image_url', '')->orderBy('created_date', 'desc')->limit(10)->get();
    }

    // Metrics not stable yet
    public static function lessImportantStories(){
        return DB::table('timeline_stories')->orderBy('created_date', 'desc')->orderBy('no_of_reads', 'desc')->where('image_url', '<>', '')->where('is_top', 0)->limit(10)->get();
    }

    //Scope for the recent stories alone from all categories
    public function scopeRecent($query){
        return $query->orderBy('created_date', 'desc')->limit(200);
    }

    //Selects the timeline stories based on the number of
    public static function timelineStoriesByCat($category_id){
        return DB::table('timeline_stories')->select(DB::raw('id, story_id, title, description, category_id, pub_id, pub_date, content, url, image_url, no_of_reads, created_date'))
            ->orderBy('created_date', 'desc')->where('status_id', 1)->where('category_id', $category_id)->limit(5)->get();
    }

    // Inserts into the timeline story table
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

    public static function topStories(){
        $top_stories_1 = TimelineStory::mostRead()->betweenXYHours('last_linkout_time', 3, 0)->get()->toArray();
        $top_stories_1 = array_merge($top_stories_1, TimelineStory::mostRecent()->betweenXYHours('created_date', 3, 0)->get()->toArray());
        $top_stories_1 = array_merge($top_stories_1, TimelineStory::mostViewed()->betweenXYHours('last_view_time', 3, 0)->get()->toArray());

        $top_stories_2 = TimelineStory::mostRead()->betweenXYHours('last_linkout_time', 6, 4)->get()->toArray();
        $top_stories_2 = array_merge($top_stories_2, TimelineStory::mostViewed()->betweenXYHours('last_view_time', 6, 4)->get()->toArray());
        $top_stories_2 = array_merge($top_stories_2, TimelineStory::mostRecent()->betweenXYHours('created_date', 6, 4)->get()->toArray());

        $top_stories_3 = TimelineStory::mostRead()->betweenXYHours('last_linkout_time', 9, 7)->get()->toArray();
        $top_stories_3 = array_merge($top_stories_3, TimelineStory::mostViewed()->betweenXYHours('last_view_time', 9, 7)->get()->toArray());
        $top_stories_3 = array_merge($top_stories_3, TimelineStory::mostRecent()->betweenXYHours('created_date', 9, 7)->get()->toArray());

        $top_stories_4 = TimelineStory::mostRead()->betweenXYHours('last_linkout_time', 12, 10)->get()->toArray();
        $top_stories_4 = array_merge($top_stories_4, TimelineStory::mostViewed()->betweenXYHours('last_view_time', 12, 10)->get()->toArray());
        $top_stories_4 = array_merge($top_stories_4, TimelineStory::mostRecent()->betweenXYHours('created_date', 12, 10)->get()->toArray());

        $top_stories = array_merge($top_stories_1, $top_stories_2, $top_stories_3, $top_stories_4);

        return $top_stories;


    }

    public static function latestStories(){
        return DB::table('timeline_stories')
            ->orderBy('created_date', 'desc')
            ->orderBy('no_of_views', 'desc')->limit(200);
    }


    public static function updateStoryViews($story_id, $time){

        $params = array(
            'story_id' => $story_id,
            'last_view_time' =>  $time
        );

        DB::table('timeline_stories')->where('story_id', $story_id)
            ->increment('no_of_views');

        DB::update("UPDATE timeline_stories SET last_view_time = :last_view_time WHERE story_id = :story_id", $params);

    }

    public static function updateStoryLinkOuts($story_id, $time){
        $params = array(
            'story_id' => $story_id,
            'last_linkout_time' => date("Y-m-d H:i:s", $time)
        );


        DB::table('timeline_stories')->where('story_id', $story_id)->increment('link_outs');

        DB::update("UPDATE timeline_stories SET last_linkout_time = :last_linkout_time WHERE story_id = :story_id", $params);

    }

    //last x hours stories
    public function scopeBetweenXYHours($query, $param, $x, $y){
        $timezone = new \DateTimeZone('Africa/Lagos');
        $last_x_hours = new \DateTime('-'.$x.' hours');
        $last_y_hours = new \DateTime('-'.$y.' hours');

        return $query->whereBetween($param, [$last_x_hours, $last_y_hours]);
    }

    //Most read stories
    public function scopeMostRead($query){
        return $query->orderBy('link_outs', 'desc');
    }

    //Most recent stories
    public function scopeMostRecent($query){
        return $query->orderBy('created_date', 'desc');
    }


    //Most viewed stories
    public function scopeMostViewed($query){
        return $query->orderBy('no_of_views', 'desc');
    }

    // Fresh stories
    public function scopeFreshStories($query){
        $timezone = new \DateTimeZone('Africa/Lagos');

        $now = new \DateTime('now');
        $thirty_minutes_ago = new \DateTime('-30minutes');
        return $query->whereBetween('created_date', [$thirty_minutes_ago, $now])->orderBy('created_date', 'desc');
    }

    //Rankable stories
    public function scopeRankable($query){
        $timezone = new \DateTimeZone('Africa/Lagos');

        $a = new \DateTime('-12hours');
        $b = new \DateTime('-31minutes');
        return $query->whereBetween('created_date', [$a, $b]);
    }

    //Stories that are displayed on the timeline
    public static function timeLineStories(){
        $timeline_stories = array();
        $ranked_stories = array();
        $fresh_stories = TimelineStory::freshStories()->get()->toArray();
        $rankable_stories = TimelineStory::rankable()->get()->toArray();

        $timezone = new \DateTimeZone('Africa/Lagos');
        $now = new \DateTime('now', $timezone);
        $now_timestamp = $now->getTimestamp();


        foreach($rankable_stories as $story){
            $created_date = new \DateTime($story['created_date']);
            $story_age = $now_timestamp - $created_date->getTimestamp();
            $story['rank_score'] =  86400.0/$story_age * $story['no_of_views']/$story_age;
            array_push($ranked_stories, $story);
        }
        $timeline_stories = array_values(array_sort($ranked_stories, function ($value) {
            return $value['rank_score'];
        }));

        $returning_stories = array_merge($fresh_stories, array_reverse($timeline_stories));


        return $returning_stories;

    }



}

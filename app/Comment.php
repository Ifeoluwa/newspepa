<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    //

    public static function activeComments(){
        $activeComments = DB::table('comments')->join('timeline_stories', 'comments.story_id', '=', 'timeline_stories.story_id')
            ->select('timeline_stories.title', 'comments.*')->where('comments.status_id', 1)
            ->orderBy('comments.created_date', 'DESC')->get();
        return $activeComments;
    }

    public static function allComments(){
        $all_comments = DB::table('comments')->join('timeline_stories', 'comments.story_id', '=', 'timeline_stories.story_id')
        ->select('timeline_stories.title', 'comments.*')->whereNotIn('comments.status_id', [4])->orderBy('comments.created_date', 'DESC');
        return $all_comments;
    }

    public static function thisStoryComments($story_id){
        $story_comments = DB::table('comments')
            ->where('story_id', $story_id)
            ->where('status_id', 1)->orderBy('created_date', 'ASC')->get();
        return $story_comments;
    }

}

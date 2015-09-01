<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
use App\Publisher;
use App\TimelineStory;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public $categories = array(1 => "Nigeria", 2 => "Politics", 3 => "Entertainment", 4 => "Sports", 5 => "Metro", 6 => "Business", 7 => 'BBC Hausa');


    public function newStory(){
        $categories = CategoryController::getCategories();
        $publishers = PublisherController::getIconwayPub();

        return view('admin.newStory')->with('data', array('categories' => $categories, 'publishers' => $publishers));
    }

    public function getDashboard(){

        try{
            $all_stories =  DB::table('timeline_stories')
                ->select('id', 'story_id', 'title', 'image_url', 'category_id', 'pub_id', 'no_of_views', 'last_view_time', 'link_outs', 'last_linkout_time', 'created_date', 'rank_score')
                ->where('status_id', 1)->orderBy('created_date', 'desc')
                ->paginate(100);
            return view('admin.dashboard')->with('data', array('stories' => $all_stories, 'categories' => $this->categories, 'publishers' => Publisher::$publishers, 'story_stats' => $this->getStoryStats()));

        }catch (\Exception $ex){
            echo "<pre>";
            echo $ex->getMessage();
            echo "</pre>";
        }


    }

    public function getStoryActions(){
        try{
            $all_stories = DB::table('timeline_stories')
                ->select('id', 'story_id', 'title', 'created_date')
                ->where('status_id', 1)->orderBy('created_date', 'desc')
                ->paginate(100);

            return view('admin.actions')->with('data', array('stories' => $all_stories, 'categories' => $this->categories, 'publishers' => Publisher::$publishers));
        }
        catch(\ErrorException $ex){
            return view('errors.404');
        }
        catch(NotFoundHttpException $nfe){
            return view('errors.404');
        }
    }

   // Gets the story stats: views, linkouts etc
    public function getStoryStats(){
        $story_stats = array();
        $story_stats['today_views'] = TimelineStory::todayViews();
        $story_stats['today_linkouts'] = TimelineStory::todayLinkouts();
        $story_stats['total_views'] = TimelineStory::totalViews();
        $story_stats['total_linkouts'] = TimelineStory::totalLinkouts();
        //        $total_stories;
//        $today_stories
        return $story_stats;

    }

    //Fetches all comments about stoires
    public function getComments(){

        $all_comments = Comment::allComments()->paginate(100);
        return view('admin.comments')->with('data', array('comments' => $all_comments));
    }




}

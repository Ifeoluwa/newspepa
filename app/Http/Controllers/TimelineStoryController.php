<?php

namespace App\Http\Controllers;

use App\Publisher;
use App\TimelineStory;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TimelineStoryController extends Controller
{
    /**
     * Display a listing of the timeline stories.
     *
     * @return Response
     */


    public function index()
    {
        //
        $timeline_stories = array();
        $timeline_stories['important'] = $this->getImportantStory();
        $timeline_stories['less_important'] = $this->getLessImportantStories();
        $timeline_stories['no_images'] = $this->getNoImageStories();
        return view('index')->with("data", array('timeline_stories' => $timeline_stories, 'publishers_name' => Publisher::$publishers));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    public function getImportantStory(){
        return DB::table('timeline_stories')->select(DB::raw('id, title, description, category_id, pub_id, pub_date, content, url, image_url, max(no_of_reads) as no_of_reads'))
            ->orderBy('pub_date', 'desc')->where('status_id', 1)->get();
    }

    public function getNoImageStories(){
        return DB::table('timeline_stories')->where('image_url', '')->orderBy('pub_date', 'desc')->limit(10)->get();
    }

    public function getLessImportantStories(){
        return DB::table('timeline_stories')->limit(10)->orderBy('pub_date', 'desc')->orderBy('no_of_reads', 'desc')->get();
    }


}

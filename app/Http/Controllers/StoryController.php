<?php
/**
 * Created by PhpStorm.
 * User: Babajide Owosakin
 * Date: 6/18/2015
 * Time: 5:35 PM
 */

namespace App\Http\Controllers;

use App\Category;
use App\Publisher;
use App\Story;
use App\TimelineStory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Solarium\Core\Client\Adapter;
use Solarium\Core\Client;


class StoryController extends Controller {


    protected $client;
    //handles the addition of story to the database
    public function addStory(){

    }

//    public function createTimelineStory(){
//        set_time_limit(0);
//        // Stories to Timeline Stories
//
//        DB::transaction(function(){
//            $stories = DB::table('stories')->where('status_id', 1)->get();
//            foreach($stories as $story){
//                $story['story_url'] = $this->makeStoryUrl($story['title'], $story['id']);
//                $story['story_id'] = $story['id'];
//                $timeline_story = array_except($story, ['id']);
//                TimelineStory::insertIgnore($timeline_story);
//            }
//
//        });
//
//        // Cluster-Pivot Method
////        $pivots = Story::pivots();
////
////        foreach($pivots as $pivot){
////
////            $pivot['story_url'] = $this->makeStoryUrl($pivot['title'], $pivot['cluster_pivot']);
////            $pivot['story_id'] = $pivot['cluster_pivot'];
////            array_pull($pivot, 'cluster_pivot');
////            array_pull($pivot, 'cluster_match');
////
////
////            $pivot['is_pivot'] = 1;
////
////            TimelineStory::insertIgnore($pivot);
////            $matches = Story::matches($pivot['story_id']);
////
////            foreach($matches as $match){
////
////                $match['story_url'] = $this->makeStoryUrl($match['title'], $match['cluster_match']);
////                $match['story_id'] = $match['cluster_match'];
////                array_pull($match, 'cluster_pivot');
////                array_pull($match, 'cluster_match');
////
////                TimelineStory::insertIgnore($match);
////            }
////
////        }
//
//        set_time_limit(120);
//
//    }

    //
    public function createTimelineStory(){
        set_time_limit(0);
        // Stories to Timeline Stories
        //solr insert
        $this->client = new \Solarium\Client;
        $stories_array = array();
        // DB::transaction(function(){
        $stories = DB::table('stories')->where('status_id', 1)->get();
        foreach($stories as $story){
            $story['story_url'] = $this->makeStoryUrl($story['title'], $story['id']);
            $story['story_id'] = $story['id'];
            $timeline_story = array_except($story, ['id']);
            $id = TimelineStory::insertIgnore($timeline_story);
            $date = new \DateTime('now');

            if($id !== false){
                $updateQuery = $this->client->createUpdate();
                $story1 = $updateQuery->createDocument();
                $story1->id = $story['story_id']; //return the id of the insert from PDO query and attach it here
                $story1->title_en = $story['title'];
                $story1->description_en = $story['description'];
                if(isset($story['image_url'])){
                    $story1->image_url_t = $story['image_url'];
                }else{
                    $story1->image_url_t = '';
                }
                $story1->video_url_t = '';
                $story1->url = $story['url'];
                $story1->pub_id_i = $story['pub_id'];
                $story1->has_cluster_i = 1;
                $story1->links = $date->getTimestamp(); //PLEASE NOTE, you are using a string field to store date in solr
                //do this for all stories and keep adding them to the stories array
                //when done continue to the nest line
//                array_push($stories_array, $story1);
                $updateQuery->addDocument($story1);
                $updateQuery->addCommit();

                $result = $this->client->update($updateQuery);
            }
        }

        // });

        // Cluster-Pivot Method
//        $pivots = Story::pivots();
//
//        foreach($pivots as $pivot){
//
//            $pivot['story_url'] = $this->makeStoryUrl($pivot['title'], $pivot['cluster_pivot']);
//            $pivot['story_id'] = $pivot['cluster_pivot'];
//            array_pull($pivot, 'cluster_pivot');
//            array_pull($pivot, 'cluster_match');
//
//
//            $pivot['is_pivot'] = 1;
//
//            TimelineStory::insertIgnore($pivot);
//            $matches = Story::matches($pivot['story_id']);
//
//            foreach($matches as $match){
//
//                $match['story_url'] = $this->makeStoryUrl($match['title'], $match['cluster_match']);
//                $match['story_id'] = $match['cluster_match'];
//                array_pull($match, 'cluster_pivot');
//                array_pull($match, 'cluster_match');
//
//                TimelineStory::insertIgnore($match);
//            }
//
//        }
        set_time_limit(120);

    }


    //    Creates the full story url
    public function makeStoryUrl($title, $id){
        $url = strtolower($title) ;

        $url = preg_replace("/[^a-z0-9_\s-]/", "", $url);
        //Clean up multiple dashes or whitespaces
        $url = preg_replace("/[\s-]+/", " ", $url);
        //Convert whitespaces and underscore to dash
        $url = preg_replace("/[\s_]/", "-", $url);
        return $url.'-'.($id);
    }

    public static function getOldStories(){
        $stories = DB::table('clusters')
            ->join('stories', 'clusters.cluster_pivot',  '=',  'stories.id')->select('stories.id as id', 'stories.title as title', 'stories.description as description')
            ->whereBetween('clusters.created_date', [new \DateTime('-12hours'), new \DateTime('now')])->get();

        return StoryController::prepareStories($stories);

    }

    public static function prepareStories($stories){
        $clean_stories = array();
        foreach($stories as $story){
            $story['title'] = strip_tags($story['title']);
            $story['title'] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $story['title']);
            $title = mb_convert_encoding($story['title'], "UTF-8", "Windows-1252");
            $story['title'] = html_entity_decode($title, ENT_QUOTES, "UTF-8");

            $story['title'] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $story['title']);

            //$desc = mb_convert_encoding($story['description'], "UTF-8", "Windows-1252");
            //$story['description'] = html_entity_decode($desc, ENT_QUOTES, "UTF-8");

            //$story['description'] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $data['description']);

            $story['description'] = strip_tags($story['description']);
            $story['description'] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $story['description']);
            $desc = mb_convert_encoding($story['description'], "UTF-8", "Windows-1252");
            $story['description'] = html_entity_decode($desc, ENT_QUOTES, "UTF-8");

            array_push($clean_stories, $story);
        }
        return $clean_stories;
    }

    public static function matchStories($old_stories, $new_stories){
        $data = array($old_stories, $new_stories);
        $result = exec('python /var/www/html/newspepa/public/scripts/test.py ' . escapeshellarg(json_encode($data)));
        return json_decode($result, true);
    }

    //admin functionalities from here
    public function solrInsert($data){
        $date = new \DateTime('now');
        $this->client = new \Solarium\Client;
        $updateQuery = $this->client->createUpdate();

        $story1 = $updateQuery->createDocument();
        $story1->id = $data['id']; //return the id of the insert from PDO query and attach it here
        $story1->title_en = $data['title'];
        $story1->description_en = $data['description'];
        if(isset($data['image_url'])){
            $story1->image_url_t = $data['image_url'];
        }else{
            $story1->image_url_t = '';
        }
        $story1->video_url_t = $data['video_url'];
        $story1->url = $data['url'];
        $story1->pub_id_i = $data['pub_id'];
        $story1->has_cluster_i = 1;
        $story1->links = $date->getTimestamp();


        $updateQuery->addDocument($story1);
        $updateQuery->addCommit();

        $result = $this->client->update($updateQuery);
    }

    public function adminPost(Request $request){

        try {
            $date = new \DateTime('now');

            //insert into stories table
            $story_details['title'] = $request->input('title');
            $story_details['description'] = $request->input('description');
            $story_details['pub_id'] = $request->input('publisher');
            $story_details['category_id'] = $request->input('category');
            $story_details['description'] = $request->input('description')."\n";

            if($request->hasFile('story_images')){
                $first_image_name = $request->file('story_images')[0]->getClientOriginalName();
                $story_details['image_url'] = "story_images/".$first_image_name;
                $count = 1;
                foreach($request->file('story_images') as $story_image){
                    $image_name = $story_image->getClientOriginalName();
                    $image_path = "story_images/".$image_name;
                    $story_image->move(base_path() .'/public/story_images', $image_name);
                    if($count >= 2){
                        $story_details['description'] .= "<img src='".$image_path."'></br>";

                    }
                    $count++;
                }
            }
//            $story_details['description'] = htmlentities($story_details['description']);
            $story_details['pub_date'] = $date;
            $story_details['has_cluster'] = 1;
            $story_details['created_date'] = $date;
            $story_details['modified_date'] = $date;

            $story = DB::insert('INSERT IGNORE INTO stories ('.implode(",", array_keys($story_details)).
                ') values (?'.str_repeat(',?', count($story_details) - 1).')', array_values($story_details));

            if($story == true){
                $story_details['story_id'] = DB::getPdo()->lastInsertId();

                //insert into timeline stories
                $result = DB::insert('INSERT IGNORE INTO timeline_stories ('.implode(',',array_keys($story_details)).
                    ') values (?'.str_repeat(',?',count($story_details) - 1).')',array_values($story_details));
                if($result == true){
                    $result = DB::getPdo()->lastInsertId();
                }

                if($result !== false){
                    $story_details['id'] = $result;
                    $this->solrInsert($story_details);
                    return view('dashboard');
                }
            }
            return redirect('admin/story/new')->with('success', "Story has been successfully added");
        }catch (\ErrorException $ex){
            return redirect('admin/story/new')->withErrors('errors', 'Oops! Something went wrong');
        } catch (NotFoundHttpException $nfe){
            return redirect('admin/story/new')->withErrors('errors', 'Oops! Something went wrong');;
        }catch(FileException $fex){
            return redirect('admin/story/new')->withErrors('errors', 'Oops! Something went wrong. Upload error');
        }
    }

    public function schedulePost(){
        try{
            $post_details = \Illuminate\Support\Facades\Input::get('post_details');
            $date = new \DateTime('now');

            $post_details['status_id'] = 4;
            $post_details['created_date'] = $date;
            $post_details['modified_date'] = $date;
            $result = DB::insert('INSERT INTO stories ('.implode(',',array_keys($post_details)).
                ') values (?'.str_repeat(',?',count($post_details) - 1).')',array_values($post_details));
            if($result == true){
                $result = DB::getPdo()->lastInsertId();
                return view('dashboard');
            }
        }catch (\ErrorException $ex){
            return view('errors.404');
        }catch (NotFoundHttpException $nfe){
            return view('errors.404');
        }
    }

    public function getAllImages(){
        try{
            $images_url = DB::table('timeline_stories')->get();
            for($i = 0; $i < count($images_url); ++$i){
                if(strpos($images_url[$i],'http') == false){
                    $images_url[$i] = 'newspepa.com/'.$images_url[$i];
                }
            }
            return $images_url;
        }
        catch(\ErrorException $ex){
            return view('errors.404');
        }
        catch (NotFoundHttpException $nfe){
            return view('errors.404');
        }
    }

    public function updateStory(Request $request){

        try{
            $story_data = $request->all();
            $story_updates = array();
            $date = new \DateTime('now', new \DateTimeZone('Africa/Lagos'));
            $story_updates['title'] = $story_data['title'];
            $story_updates['category_id'] = $story_data['category'];
            $story_updates['pub_id'] = $story_data['publisher'];
            $story_updates['description'] = $story_data['description'];
            $story_updates['modified_date'] = $date;

            if($request->hasFile('story_images')){
                $first_image_name = $request->file('story_images')[0]->getClientOriginalName();
                $story_updates['image_url'] = "story_images/".$first_image_name;
                $count = 1;
                foreach($request->file('story_images') as $story_image){
                    $image_name = $story_image->getClientOriginalName();
                    $image_path = "story_images/".$image_name;
                    $story_image->move(base_path() .'/public/story_images', $image_name);
                    if($count >= 2){
                        $story_updates['description'] .= "<img src='".$image_path."'></br>";

                    }
                    $count++;
                }
            }

            $update = DB::table('stories')
                ->where('id', $story_data['story_id'])
                ->update($story_updates);
            if($update){
                $story_updates['story_id'] = $story_data['story_id'];
                $update2 = DB::table('timeline_stories')
                    ->where('story_id', $story_data['story_id'])
                    ->update($story_updates);
            }

            return redirect('admin/story/actions')->with('success', 'Update successful!');
        }catch (\ErrorException $ex){

            return back()->with('failure', 'Unable to update story :(');
        }catch (NotFoundHttpException $nfe){

            return back()->with('failure', 'Unable to update story :(');
        }catch (\Exception $ex){
            return back()->with('failure', 'Unable to update story :(');

        }
    }

    public function deleteStory($story_id){

        try{
            $delete = DB::table('stories')
                ->where('id', $story_id)
                ->update(['status_id'=> 2]);

            if($delete){
                $delete = DB::table('timeline_stories')
                    ->where('story_id', $story_id)
                    ->update(['status_id'=> 2]);
            }

            return redirect('/admin/story/actions')->with('success', 'Story has been deleted!');
        }
        catch(\ErrorException $ex){
            return redirect('/admin/story/actions')->with('failure', 'Unable to delete story :(');
        }
        catch(NotFoundHttpException $nfe){
            return redirect('/admin/story/actions')->with('failure', 'Unable to delete story :(');

        }catch(\Exception $ex){
            return redirect('/admin/story/actions')->with('failure', 'Unable to delete story :(');

        }
    }

    public function getAllStories(){

        try{
            $all_stories = DB::table('timeline_stories')
                ->select('id', 'story_id', 'title', 'image_url', 'category_id', 'pub_id', 'no_of_views', 'last_view_time', 'link_outs', 'last_linkout_time', 'created_date')
                ->where('status_id', 1)
                ->get();

            return $all_stories;
        }
        catch(\ErrorException $ex){
            return view('errors.404');
        }
        catch(NotFoundHttpException $nfe){
            return view('errors.404');
        }
    }

    public function editStory($story_id){
        $categories = CategoryController::getCategories();
        $publishers = PublisherController::getIconwayPub();
        $story_details = DB::table('timeline_stories')->where('story_id', $story_id)->get();
        return view('admin.editStory')->with('data', array('story_details' => $story_details[0], 'categories' => $categories, 'publishers' => $publishers));

    }

} 
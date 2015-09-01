<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        try{
            //Stores the comment in the database
            $comment_details = array();
            $comment_details['session_id'] = isset($_SESSION['session_id'])? $_SESSION['session_id']:101;
            $comment_details['story_id'] = $request->input('story_id');
            $comment_details['user_name'] = $request->input('user_name');
            $comment_details['comment'] = $request->input('comment');
            $comment_details['created_date'] = new \Carbon\Carbon('now');
            $comment_details['modified_date'] = $comment_details['created_date'];
            DB::table('comments')->insert($comment_details);
            return json_encode(true);
        }catch (\Exception $ex){
            return json_encode(false);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function getComments($story_id){

        $story_comments = DB::table('comments')
            ->where('story_id', $story_id)
            ->where('status_id', 1)->orderBy('created_date', 'DESC')->get();
        return $story_comments;
    }

    public function approve($comment_id){
        $result = DB::table('comments')->where('id', $comment_id)->update(['status_id' => 1]);
        return $result;
    }

    public function disapprove($comment_id){
        $result = DB::table('comments')->where('id', $comment_id)->update(['status_id' => 2]);
        return $result;
    }

    public function delete($comment_id){
        $result = DB::table('comments')->where('id', $comment_id)->update(['status_id' => 4]);
        return $result;
    }


}

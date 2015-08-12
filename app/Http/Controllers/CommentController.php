<?php

namespace App\Http\Controllers;

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
        return $request->session()->get('key');
        try{
            //Stores the comment in the database
            $comment_details = array();
            $comment_details['session_key'] = $request->session()->get('key');;
            $comment_details['story_id'] = $request->input('story_id');
            $comment_details['user_name'] = $request->input('user_name');
            $comment_details['comment'] = $request->input('comment');
            $comment_details['created_date'] = new \Carbon\Carbon('now');
            $comment_details['modified_date'] = $comment_details['created_date'];
            DB::table('comments')->insert($comment_details);
        }catch (\Exception $ex){
            echo json_encode($ex->getMessage());
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
        $story_comments = DB::table('comments')->where('story_id', $story_id)
            ->where('status_id', 1)->orderBy('created_date', 'ASC')->get();
        return $story_comments;
    }
}

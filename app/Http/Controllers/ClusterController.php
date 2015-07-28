<?php

namespace App\Http\Controllers;

use App\Cluster;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ClusterController extends Controller
{
    //Stores matched stories in cluster table
    public static function storeMatchedStories($array){
        foreach($array as $story){

            Cluster::insertIgnore($story);

        }
    }
}

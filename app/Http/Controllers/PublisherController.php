<?php

namespace App\Http\Controllers;

use App\Publisher;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PublisherController extends Controller
{

    public static function getIconwayPub(){
        // Gets all the publishers associated with Iconway Media
        $iconway_pub = Publisher::whereIn('id', [4, 5, 10])->get();

        return $iconway_pub;
    }
}

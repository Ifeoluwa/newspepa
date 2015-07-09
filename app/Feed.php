<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Feed extends Model
{
    //


    public static function updateFeed($feed_id, $time){

        $params = array(
            'id' => $feed_id,
            'last_access' => date("Y-m-d H:i:s", $time)
        );

        DB::update("UPDATE feeds SET last_access = :last_access WHERE id = :id", $params);


    }
}

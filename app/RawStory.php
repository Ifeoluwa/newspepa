<?php
/**
 * Created by PhpStorm.
 * User: Babajide Owosakin
 * Date: 6/19/2015
 * Time: 5:15 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RawStory extends Model {


    public static function insertIgnore($array){
        $a = new static();
        if($a->timestamps){
            $now = \Carbon\Carbon::now();
            $array['created_date'] = $now;
            $array['modified_date'] = $now;
        }

        DB::insert('INSERT IGNORE INTO raw_stories ('.implode(',',array_keys($array)).
            ') values (?'.str_repeat(',?',count($array) - 1).')',array_values($array));

    }

} 
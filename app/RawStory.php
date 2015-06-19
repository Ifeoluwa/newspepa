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
            $array['created_at'] = $now;
            $array['modified_at'] = $now;
        }

        print_r('INSERT IGNORE INTO '.$a->table.' ('.implode(',',array_keys($array)).
            ') values ('.implode(',', array_values($array)));

//        DB::insert('INSERT IGNORE INTO '.$a->table.' ('.implode(',',array_keys($array)).
//            ') values ('.implode(',',array_values($array)));

    }

} 
<?php
/**
 * Created by PhpStorm.
 * User: iconway
 * Date: 23/06/2015
 * Time: 10:55
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;




class GetRawStory extends Model{

  protected function multiexplode ($delimiters,$string) {

        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }

    public function matchStory(){
        $raw_stories = DB::table('raw_stories')->select('íd','title','description','content','pub_id','category_id')->get();

            $pivot = $raw_stories;
            $matches = $raw_stories;

            $pivotStorySmallCase = array_map('strtolower', $pivot);
            $matchingStorySmallCase = array_map('strtolower', $matches);



    }

}
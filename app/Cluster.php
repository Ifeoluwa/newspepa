<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cluster extends Model
{


    // Inserts into the cluster table only when the item is unique
    public static function insertIgnore($array){
        foreach($array as $cluster){
            $a = new static();
            if($a->timestamps){
                $now = \Carbon\Carbon::now();
                $cluster['cluster_pivot'] = $cluster['pivot_id'];
                $cluster['cluster_match'] = $cluster['id'];
                $cluster['created_date'] = $now;
                $cluster['modified_date'] = $now;
            }

            $cluster = array_except($cluster, ['pivot_id', 'id', 'description', 'title']);

            $result = DB::table('clusters')->select('cluster_pivot', 'cluster_match')
                ->where('cluster_pivot', $cluster['cluster_pivot'])
                ->where('cluster_match', $cluster['cluster_match'])->get();

            if(count($result) === 0){

                DB::insert('INSERT IGNORE INTO clusters ('.implode(',',array_keys($cluster)).
                    ') values (?'.str_repeat(',?',count($cluster) - 1).')',array_values($cluster));

            }
        }



    }

}

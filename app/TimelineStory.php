<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimelineStory extends Model
{
    //
    //Returns stories that are popular
    public function scopePopular($query){
        return $query->where('reads', '>', 100);
    }

    //timeline stories that are active
    public function scopeActive($query){
        return $query->where('status_id', 1);
    }
}

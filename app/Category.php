<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public static $news_category = array('latest-nigeria-news-in-nigeria' => 1, 'latest-politics-news-in-nigeria' => 2, 'latest-entertainment-news-in-nigeria' => 3,
        'latest-sports-news-in-nigeria' => 4, 'latest-metro-news-in-nigeria' => 5, 'latest-business-news-in-nigeria' => 6);

    public static $categories = array(1 => "Nigeria", 2 => "Politics", 3 => "Entertainment", 4 => "Sports", 5 => "Metro", 6 => "Business");



}
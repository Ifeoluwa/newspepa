<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    //Please do not alter!

    public static $publishers = ['1' => 'NIGERIAN TRIBUNE', '2' => 'PUNCH', '3' => 'LEADERSHIP', '4' =>  'KOKOFEED', '5' => 'NIGERIAN MONITOR', '6' => 'VANGUARD', '7' => 'THE CABLE', '8' => 'THE GUARDIAN',
        '9' => 'CHANNELS TV', '10' => 'STARGIST', '11' => 'BELLANAIJA', '12' => 'LINDA IKEJI', '13' => 'GOAL.COM', '14' => 'FUTAA', '15' => 'COMPLETE SPORTS',
    '16' => 'SQUAKWA', '17' => 'DAILYPOST', '18' => 'THE CABLE', '19' => 'NET', '20' => 'PREMIUM TIMES', '21' => 'BUSINESS DAY', '22' => 'NAIRA METRICS', '23' => 'BUSINESS NEWS', '24' => 'CITY PEOPLE', '25' => 'ECOMIUM'];

    public static $publisher_route = ['latest-nigerian-tribune-news' => 1 , 'latest-punch-news' => 2, 'latest-leadership-news' => 3, 'latest-kokofeed-news' => 4, 'latest-nigerian-monitor-news' => 5, 'latest-vanguard-news' => 6, 'latest-the-cable-news' => 7, 'latest-the-guardian-news' => 8,
        'latest-channels-tv-news' => 9, 'latest-stargist-news' => 10, 'latest-bella-naija-news' => 11, 'latest-linda-ikeji-news' => 12, 'goal' => 13, 'futaa' => 14, 'complete-sports' => 15,
         'latest-squakwa-news' => 16, 'latest-daily-post-news' => 17, 'latest-the-cable-news' => 18, 'latest-net-news' => 19, 'latest-premium-times-news' => 20, 'latest-business-day-news' => 21, 'latest-naira-metrics-news' => 22, 'latest-business-news-news' => 23, 'latest-city-people-news' => 24, 'latest-ecomium-news' => 25];
}

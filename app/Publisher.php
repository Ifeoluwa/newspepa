<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    //Please do not alter!

    public static $publishers = ['1' => 'NIGERIAN TRIBUNE', '2' => 'PUNCH', '3' => 'LEADERSHIP', '4' =>  'KOKOFEED', '5' => 'NIGERIAN MONITOR', '6' => 'VANGUARD', '7' => 'THE CABLE', '8' => 'THE GUARDIAN',
        '9' => 'CHANNELS TV', '10' => 'STARGIST', '11' => 'BELLANAIJA', '12' => 'LINDA IKEJI', '13' => 'GOAL.COM', '14' => 'FUTAA', '15' => 'COMPLETE SPORTS',
        '16' => 'SQUAKWA', '17' => 'DAILYPOST', '18' => 'THE CABLE', '19' => 'NET', '20' => 'PREMIUM TIMES', ];

    public static $publisher_route = ['nigerian-tribune' => 1 , 'punch' => 2, 'leadership' => 3, 'kokofeed' => 4, 'nigerian-monitor' => 5, 'vanguard' => 6, 'the-cable' => 7, 'the-guardian' => 8,
        'channels-tv' => 9, 'stargist' => 10, 'bella-naija' => 11, 'linda-ikeji' => 12, 'goal' => 13, 'futaa' => 14, 'complete-sports' => 15,
        'squakwa' => 16, 'daily-post' => 17, 'the-cable' => 18, 'net' => 19, 'premium-times' => 20, 'business-day' => 21, 'naira-metrics' => 22, 'business-news' => 23, 'city-people' => 24, 'ecomium' => 25];
}

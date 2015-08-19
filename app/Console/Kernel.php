<?php

namespace App\Console;

use App\Http\Controllers\FeedController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\TimelineStoryController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->call(function(){
            echo "Level 1 begins:: Fetching + Matching";
            $fc = new FeedController();
            $fc->fetchFeeds();
            echo "\nFetch feeds successful";
        })->then(function(){
            echo "Level 3 begins:: Creating Timeline Stories";
            $sc = new StoryController();
            echo "\nCreate timeline story completed!";
        })->everyFiveMinutes();


    }
}

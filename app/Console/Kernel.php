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
        $schedule->command('inspire')
                 ->hourly();

        $schedule->call(function(){
            $fc = new FeedController();
            $fc->fetchFeeds();
        })->everyTenMinutes();

        $schedule->call('FeedController@fetchFeeds')->everyTenMinutes();

        $schedule->call(function(){
            $sc = new StoryController();
            $sc->createTimelineStory();
        })->everyTenMinutes();

        $schedule->call('StoryController@createTimelineStory')->everyTenMinutes();

    }
}

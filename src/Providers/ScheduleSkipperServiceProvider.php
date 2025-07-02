<?php

declare(strict_types=1);

namespace NNovosad19\ScheduleSkipper\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class ScheduleSkipperServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->afterResolving(Schedule::class, function (Schedule $schedule) {
            if ($this->app->environment('local')) {
                $schedule->events = collect($schedule->events)->filter(function ($event) {
                    return false;
                })->all();
            }
        });
    }
}
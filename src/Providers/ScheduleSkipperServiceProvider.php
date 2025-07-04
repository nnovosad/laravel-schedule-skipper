<?php

declare(strict_types=1);

namespace NNovosad19\ScheduleSkipper\Providers;

use Illuminate\Support\ServiceProvider;
use NNovosad19\ScheduleSkipper\Contracts\ScheduleSkipperInterface;
use NNovosad19\ScheduleSkipper\Services\ScheduleSkipperService;
use Illuminate\Console\Scheduling\Schedule;

class ScheduleSkipperServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            dirname(__DIR__, 2).'/config/schedule-skipper.php' => config_path('schedule-skipper.php'),
        ], 'schedule-skipper');

        $this->app->afterResolving(Schedule::class, function (Schedule $schedule) {
            $this->app->make(ScheduleSkipperInterface::class)->clearSchedule($schedule);
        });
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            dirname(__DIR__, 2) . '/config/schedule-skipper.php',
            'schedule-skipper',
        );

        $this->app->bind(ScheduleSkipperInterface::class, ScheduleSkipperService::class);
    }
}
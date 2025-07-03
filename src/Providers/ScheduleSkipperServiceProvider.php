<?php

declare(strict_types=1);

namespace NNovosad19\ScheduleSkipper\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use ReflectionClass;

class ScheduleSkipperServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            dirname(__DIR__, 2).'/config/schedule-skipper.php' => config_path('schedule-skipper.php'),
        ], 'schedule-skipper');

        $this->app->afterResolving(Schedule::class, function (Schedule $schedule) {
            if (app()->environment(config('schedule-skipper.env'))) {
                $ref = new ReflectionClass($schedule);

                if ($ref->hasProperty('events')) {
                    $events = $ref->getProperty('events');

                    if ($events->isProtected()) {
                        $events->setAccessible(true);
                        $events->setValue($schedule, []);
                    }
                }
            }
        });
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            dirname(__DIR__, 2) . '/config/schedule-skipper.php',
            'schedule-skipper',
        );
    }
}
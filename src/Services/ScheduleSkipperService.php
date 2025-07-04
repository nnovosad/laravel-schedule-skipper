<?php

declare(strict_types=1);

namespace NNovosad19\ScheduleSkipper\Services;

use NNovosad19\ScheduleSkipper\Contracts\ScheduleSkipperInterface;
use Illuminate\Console\Scheduling\Schedule;
use ReflectionClass;

class ScheduleSkipperService implements ScheduleSkipperInterface
{
    protected const SEPARATOR = ',';

    public function clearSchedule(Schedule $schedule): void
    {
        if (app()->environment($this->getEnvs())) {
            $ref = new ReflectionClass($schedule);

            if ($ref->hasProperty('events')) {
                $events = $ref->getProperty('events');

                if ($events->isProtected()) {
                    $events->setAccessible(true);
                    $events->setValue($schedule, []);
                }
            }
        }
    }

    protected function getEnvs(): array
    {
        return explode(
            static::SEPARATOR,
            config('schedule-skipper.env'),
        );
    }
}
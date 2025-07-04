<?php

namespace NNovosad19\ScheduleSkipper\Contracts;

use Illuminate\Console\Scheduling\Schedule;

interface ScheduleSkipperInterface
{
    public function clearSchedule(Schedule $schedule): void;
}
<?php

namespace App\Actions;


use Carbon\Carbon;

class TimeLeft
{
    public function __invoke($created_at): int
    {
        return 300 - now()->diffInSeconds(Carbon::parse($created_at));
    }
}

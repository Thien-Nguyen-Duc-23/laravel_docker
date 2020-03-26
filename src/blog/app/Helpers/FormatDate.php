<?php

use Carbon\Carbon;

function diffNow($date)
{
    Carbon::setLocale('en');
    $createdAt = Carbon::parse($date);
    $now = Carbon::now();
    
    return $createdAt->diffForHumans($now);
}

<?php

namespace emilhorlyck\PolyMetric\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \emilhorlyck\PolyMetric\PolyMetric
 */
class PolyMetric extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \emilhorlyck\PolyMetric\PolyMetric::class;
    }
}

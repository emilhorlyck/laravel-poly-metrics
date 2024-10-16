<?php

namespace EmilHorlyck\PolyMetric\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \EmilHorlyck\PolyMetric\PolyMetric
 */
class PolyMetric extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \EmilHorlyck\PolyMetric\PolyMetric::class;
    }
}

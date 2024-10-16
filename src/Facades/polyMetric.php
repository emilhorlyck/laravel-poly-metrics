<?php

namespace Emilhorlyck\PolyMetric\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Emilhorlyck\PolyMetric\PolyMetric
 */
class PolyMetric extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Emilhorlyck\PolyMetric\PolyMetric::class;
    }
}

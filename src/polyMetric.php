<?php

namespace emilhorlyck\PolyMetric;

class PolyMetric
{
    public function set($name, $value, $month = null, $year = null): array
    {
        $metric = Metrics::Create([
            'name' => $name,
            'value' => $value,
            'month' => $month ?? now()->month,
            'year' => $year ?? now()->year,
        ]);

        return $metric->toArray();
    }

    public function setDaily($name, $value, $day = null, $month = null, $year = null)
    {
        $metric = DailyMetrics::Create([
            'name' => $name,
            'value' => $value,
            'day' => $day ?? now()->day,
            'month' => $month ?? now()->month,
            'year' => $year ?? now()->year,
        ]);

        return $metric->toArray();
    }
}

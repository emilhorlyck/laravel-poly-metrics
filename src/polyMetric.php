<?php

namespace emilhorlyck\PolyMetric;

class PolyMetric
{
    public function set($name, $value, $day = null, $month = null, $year = null): array
    {
        $dailyMetric = $this->setDaily($name, $value, $day, $month, $year);
        $monthlyMetric = $this->setMonthly($name, $value, $month, $year);

        return [$dailyMetric->toArray(), $metric->toArray()];
    }

    public function setDaily($name, $value, $day = null, $month = null, $year = null)
    {
        $metric = DailyMetric::Create([
            'name' => $name,
            'value' => $value,
            'day' => $day ?? now()->day,
            'month' => $month ?? now()->month,
            'year' => $year ?? now()->year,
        ]);

        return $metric->toArray();
    }

    public function setMonthly($name, $value, $month = null, $year = null)
    {
        $metric = Metric::Create([
            'name' => $name,
            'value' => $value,
            'month' => $month ?? now()->month,
            'year' => $year ?? now()->year,
        ]);

        return $metric->toArray();
    }
}

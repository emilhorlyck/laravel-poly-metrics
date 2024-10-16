<?php

namespace emilhorlyck\PolyMetric;

use emilhorlyck\PolyMetric\Models\DailyMetric;
use emilhorlyck\PolyMetric\Models\Metric;

class PolyMetric
{
    public function set($name, $value, $day = null, $month = null, $year = null): array
    {
        $dailyMetric = $this->setDaily($name, $value, $day, $month, $year);
        $monthlyMetric = $this->setMonthly($name, $value, $month, $year);

        return [$dailyMetric, $monthlyMetric];
    }

    public function setDaily($name, $value, $day = null, $month = null, $year = null): DailyMetric
    {
        $metric = DailyMetric::Create([
            'name' => $name,
            'value' => $value,
            'day' => $day ?? now()->day,
            'month' => $month ?? now()->month,
            'year' => $year ?? now()->year,
        ]);

        return $metric;
    }

    public function setMonthly($name, $value, $month = null, $year = null): Metric
    {
        $metric = Metric::Create([
            'name' => $name,
            'value' => $value,
            'month' => $month ?? now()->month,
            'year' => $year ?? now()->year,
        ]);

        return $metric;
    }

    public function increment($name, $value = 1, $day = null, $month = null, $year = null): array
    {
        $dailyMetric = $this->incrementDaily($name, $value, $day, $month, $year);
        $monthlyMetric = $this->incrementMonthly($name, $value, $month, $year);

        return [$dailyMetric, $monthlyMetric];
    }

    public function incrementDaily($name, $value = 1, $day = null, $month = null, $year = null): DailyMetric
    {
        $metric = DailyMetric::firstOrCreate(
            [
                'name' => $name,
                'day' => $day ?? now()->day,
                'month' => $month ?? now()->month,
                'year' => $year ?? now()->year,
            ]
        );

        $metric->increment('value', $value);

        return $metric;
    }

    public function incrementMonthly($name, $value = 1, $month = null, $year = null): Metric
    {
        $metric = Metric::firstOrCreate(
            [
                'name' => $name,
                'month' => $month ?? now()->month,
                'year' => $year ?? now()->year,
            ]
        );

        $metric->increment('value', $value);

        return $metric;
    }

    public function decrement($name, $value = 1, $day = null, $month = null, $year = null): array
    {
        $dailyMetric = $this->decrementDaily($name, $value, $day, $month, $year);
        $monthlyMetric = $this->decrementMonthly($name, $value, $month, $year);

        return [$dailyMetric, $monthlyMetric];
    }

    public function decrementDaily($name, $value = 1, $day = null, $month = null, $year = null): DailyMetric
    {
        $metric = DailyMetric::firstOrCreate(
            [
                'name' => $name,
                'day' => $day ?? now()->day,
                'month' => $month ?? now()->month,
                'year' => $year ?? now()->year,
            ]
        );

        $metric->decrement('value', $value);

        return $metric;
    }

    public function decrementMonthly($name, $value = 1, $month = null, $year = null): Metric
    {
        $metric = Metric::firstOrCreate(
            [
                'name' => $name,
                'month' => $month ?? now()->month,
                'year' => $year ?? now()->year,
            ]
        );

        $metric->decrement('value', $value);

        return $metric;
    }
}

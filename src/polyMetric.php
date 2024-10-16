<?php

namespace emilhorlyck\PolyMetric;

use emilhorlyck\PolyMetric\Models\DailyMetric;
use emilhorlyck\PolyMetric\Models\Metric;

class PolyMetric
{
    // Conviniece methods for modifying metrics
    public function setMetric($name, $value, $month = null, $year = null): array
    {
        return $this->set($name, $value, null, $month, $year);
    }

    public function setDailyMetric($name, $value, $day = null, $month = null, $year = null): DailyMetric
    {
        return $this->setDaily($name, $value, $day, $month, $year);
    }

    public function setMonthlyMetric($name, $value, $month = null, $year = null): Metric
    {
        return $this->setMonthly($name, $value, $month, $year);
    }

    public function incrementMetric($name, $value = 1, $month = null, $year = null): array
    {
        return $this->increment($name, $value, null, $month, $year);
    }

    public function incrementDailyMetric($name, $value = 1, $day = null, $month = null, $year = null): DailyMetric
    {
        return $this->incrementDaily($name, $value, $day, $month, $year);
    }

    public function incrementMonthlyMetric($name, $value = 1, $month = null, $year = null): Metric
    {
        return $this->incrementMonthly($name, $value, $month, $year);
    }

    public function decrementMetric($name, $value = 1, $month = null, $year = null): array
    {
        return $this->decrement($name, $value, null, $month, $year);
    }

    public function decrementDailyMetric($name, $value = 1, $day = null, $month = null, $year = null): DailyMetric
    {
        return $this->decrementDaily($name, $value, $day, $month, $year);
    }

    public function decrementMonthlyMetric($name, $value = 1, $month = null, $year = null): Metric
    {
        return $this->decrementMonthly($name, $value, $month, $year);
    }

    // Actually modifying metrics
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

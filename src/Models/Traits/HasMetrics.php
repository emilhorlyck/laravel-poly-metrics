<?php

namespace EmilHorlyck\PolyMetric\Models\Traits;

use EmilHorlyck\PolyMetric\Models\DailyMetric;
use EmilHorlyck\PolyMetric\Models\Metric;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasMetrics
{
    public function monthlyMetrics(): MorphMany
    {
        return $this->morphMany(Metric::class, name: 'model');
    }

    public function dailyMetrics(): MorphMany
    {
        return $this->morphMany(DailyMetric::class, name: 'model');
    }

    public function setMetric(string $name, int $value, $day = null, $month = null, $year = null): array
    {
        return [
            'daily' => $this->setDailyMetric($name, $value, $day, $month, $year),
            'monthly' => $this->setMonthlyMetric($name, $value, $month, $year),
        ];
    }

    public function setDailyMetric(string $name, int $value, $day = null, $month = null, $year = null): DailyMetric
    {
        return $this->dailyMetrics()->updateOrCreate(
            [
                'name' => $name,
                'day' => $day ?? now()->day,
                'month' => $month ?? now()->month,
                'year' => $year ?? now()->year,
            ],
            [
                'value' => $value,
            ]
        );
    }

    public function setMonthlyMetric(string $name, int $value, $month = null, $year = null): Metric
    {
        return $this->monthlyMetrics()->updateOrCreate(
            [
                'name' => $name,
                'month' => $month ?? now()->month,
                'year' => $year ?? now()->year,
            ],
            [
                'value' => $value,
            ]
        );
    }

    public function incrementMetric(string $name, int $value = 1, $day = null, $month = null, $year = null): array
    {
        return [
            'daily' => $this->incrementDailyMetric($name, $value, $day, $month, $year),
            'monthly' => $this->incrementMetric($name, $value, $month, $year),
        ];
    }

    public function incrementDailyMetric(string $name, int $value = 1, $day = null, $month = null, $year = null): DailyMetric
    {
        $metric = $this->dailyMetrics()->updateOrCreate(
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

    public function incrementMonthlyMetric(string $name, int $value = 1, $month = null, $year = null): Metric
    {
        $metric = $this->metrics()->updateOrCreate(
            [
                'name' => $name,
                'month' => $month ?? now()->month,
                'year' => $year ?? now()->year,
            ]
        );

        $metric->increment('value', $value);

        return $metric;
    }

    public function decrementMetric(string $name, int $value = 1, $day = null, $month = null, $year = null): array
    {
        return [
            'daily' => $this->decrementDailyMetric($name, $value, $day, $month, $year),
            'monthly' => $this->decrementMetric($name, $value, $month, $year),
        ];
    }

    public function decrementDailyMetric(string $name, int $value = 1, $day = null, $month = null, $year = null): DailyMetric
    {
        $metric = $this->dailyMetrics()->updateOrCreate(
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

    public function decrementMonthlyMetric(string $name, int $value = 1, $month = null, $year = null): Meitric
    {
        $metric = $this->metrics()->updateOrCreate(
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

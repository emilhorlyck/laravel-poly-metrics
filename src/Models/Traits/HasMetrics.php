<?php

namespace EmilHorlyck\PolyMetric\Models\Traits;

use EmilHorlyck\PolyMetric\Models\DailyMetric;
use EmilHorlyck\PolyMetric\Models\Metric;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasMetrics
{
    public function monthlyMetrics(): MorphMany
    {
        return $this->morphMany(Metrics::class, name: 'model');
    }

    public function dailyMetrics(): MorphMany
    {
        return $this->morphMany(DailyMetrics::class, name: 'model');
    }

    public function setMetric(string $name, int $value, $day = null, $month = null, $year = null): array
    {
        $this->setDailyMetric($name, $value, $day, $month, $year);
        $this->setMonthlyMetric($name, $value, $month, $year);

        return [
            'daily' => $this->dailyMetrics()->where('name', $name)->first(),
            'monthly' => $this->monthlyMetrics()->where('name', $name)->first(),
        ];
    }

    public function setDailyMetric(string $name, int $value, $day = null, $month = null, $year = null): DailyMetric
    {
        return $this->dailyMetrics()->firstOrCreate(
            [
                'name' => $name,
                'day' => $day ?? now()->day,
                'month' => $month ?? now()->month,
                'year' => $year ?? now()->year,
            ],
            [
                'value' => 0,
            ]
        );
    }

    public function setMonthlyMetric(string $name, int $value, $month = null, $year = null): Metric
    {
        return $this->monthlyMetrics()->firstOrCreate(
            [
                'name' => $name,
                'month' => $month ?? now()->month,
                'year' => $year ?? now()->year,
            ],
            [
                'value' => 0,
            ]
        );
    }

    public function incrementMetric(string $name, int $value = 1, $day = null, $month = null, $year = null): array
    {
        $this->incrementDailyMetric($name, $value, $day, $month, $year);
        $this->incrementMetric($name, $value, $month, $year);

        return [
            'daily' => $this->dailyMetrics()->where('name', $name)->first(),
            'monthly' => $this->monthlyMetrics()->where('name', $name)->first(),
        ];
    }

    public function incrementDailyMetric(string $name, int $value = 1, $day = null, $month = null, $year = null): DailyMetric
    {
        $metric = $this->dailyMetric()->firstOrCreate(
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
        $metric = $this->metrics()->firstOrCreate(
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
        $this->decrementDailyMetric($name, $value, $day, $month, $year);
        $this->decrementMetric($name, $value, $month, $year);

        return [
            'daily' => $this->dailyMetrics()->where('name', $name)->first(),
            'monthly' => $this->monthlyMetrics()->where('name', $name)->first(),
        ];
    }

    public function decrementDailyMetric(string $name, int $value = 1, $day = null, $month = null, $year = null): DailyMetric
    {
        $metric = $this->dailyMetric()->firstOrCreate(
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
        $metric = $this->metrics()->firstOrCreate(
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

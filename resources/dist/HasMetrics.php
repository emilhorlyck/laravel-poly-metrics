<?php

namespace emilhorlyck\PolyMetric;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasMetrics
{
    public function metrics(): MorphMany
    {
        return $this->morphMany(Metrics::class, name: 'model');
    }

    public function dailyMetric(): MorphMany
    {
        return $this->morphMany(DailyMetrics::class, name: 'model');
    }

    public function incrementMetric(string $name, int $value = 1, $month = null, $year = null): void
    {
        $this->metrics()->firstOrCreate(
            [
                'name' => $name,
                'month' => $month ?? now()->month,
                'year' => $year ?? now()->year,
            ],
            [
                'value' => 0,
            ]
        )->increment('value', $value);

    }

    public function incrementDailyMetric(string $name, int $value = 1, $day = null, $month = null, $year = null, $excludeMonthlyMetric = false): void
    {
        $this->dailyMetric()->firstOrCreate(
            [
                'name' => $name,
                'day' => $day ?? now()->day,
                'month' => $month ?? now()->month,
                'year' => $year ?? now()->year,
            ],
            [
                'value' => 0,
            ]
        )->increment('value', $value);

        if (! $excludeMonthlyMetric) {
            $this->incrementMetric($name, $value, $month, $year);
        }

    }
}

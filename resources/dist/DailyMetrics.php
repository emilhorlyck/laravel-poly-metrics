<?php

namespace emilhorlyck\PolyMetric;

use Illuminate\Database\Eloquent\Model;

class DailyMetrics extends Model
{
    protected $fillable = [
        'name',
        'value',
        'day',
        'month',
        'year',
    ];

    public static function incrementGeneralMetric(string $name, int $value = 1, $day = null, $month = null, $year = null, $excludeMonthlyMetric = false): void
    {
        DailyMetrics::firstOrCreate(
            [
                'model_type' => null,
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
            Metrics::incrementGeneralMetric($name, $value, $day, $month, $year, true);
        }
    }
}

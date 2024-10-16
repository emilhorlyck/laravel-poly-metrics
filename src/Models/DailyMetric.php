<?php

namespace emilhorlyck\PolyMetric\Models;

use Illuminate\Database\Eloquent\Model;

class DailyMetric extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'laravel_daily_poly_metrics_table';

    protected $fillable = [
        'name',
        'value',
        'day',
        'month',
        'year',
    ];

    public static function incrementGeneralMetric(string $name, int $value = 1, $day = null, $month = null, $year = null, $excludeMonthlyMetric = false): void
    {
        DailyMetric::firstOrCreate(
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
            Metric::incrementGeneralMetric($name, $value, $day, $month, $year, true);
        }
    }
}

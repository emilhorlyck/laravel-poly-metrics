<?php

namespace emilhorlyck\PolyMetric\Models;

use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'laravel_monthly_poly_metrics_table';

    protected $fillable = [
        'name',
        'value',
        'month',
        'year',
    ];

    public static function incrementGeneralMetric(string $name, int $value = 1, $day = null, $month = null, $year = null, $excludeMonthlyMetric = false): void
    {
        Metric::firstOrCreate(
            [
                'model_type' => null,
                'name' => $name,
                'month' => $month ?? now()->month,
                'year' => $year ?? now()->year,
            ],
            [
                'value' => 0,
            ]
        )->increment('value', $value);
    }
}

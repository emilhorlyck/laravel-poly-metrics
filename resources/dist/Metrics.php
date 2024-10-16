<?php

namespace emilhorlyck\PolyMetric;

use Illuminate\Database\Eloquent\Model;

class Metrics extends Model
{
    protected $fillable = [
        'name',
        'value',
        'month',
        'year',
    ];

    public static function incrementGeneralMetric(string $name, int $value = 1, $day = null, $month = null, $year = null, $excludeMonthlyMetric = false): void
    {
        Metrics::firstOrCreate(
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

<?php

namespace EmilHorlyck\PolyMetric\Models;

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
}

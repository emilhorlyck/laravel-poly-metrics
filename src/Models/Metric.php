<?php

namespace Emilhorlyck\PolyMetric\Models;

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
}

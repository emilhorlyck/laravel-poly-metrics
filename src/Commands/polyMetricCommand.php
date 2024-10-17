<?php

namespace EmilHorlyck\PolyMetric\Commands;

use EmilHorlyck\PolyMetric\Facades\PolyMetric;
use Illuminate\Console\Command;

class PolyMetricCommand extends Command
{
    public $signature = 'laravel-poly-metrics';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return PolyMetric::incrementMetric('cmd-executed');
    }
}

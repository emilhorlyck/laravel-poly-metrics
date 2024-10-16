<?php

namespace emilhorlyck\PolyMetric;

use emilhorlyck\PolyMetric\Commands\PolyMetricCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PolyMetricServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-poly-metrics')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_poly_metrics_table')
            ->hasCommand(PolyMetricCommand::class);
    }
}

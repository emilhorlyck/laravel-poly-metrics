<?php

namespace emilhorlyck\PolyMetric;

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
            ->hasMigration('create_daily_poly_metrics_table')
            ->hasMigration('create_monthly_poly_metrics_table');
    }
}

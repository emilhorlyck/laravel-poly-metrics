# This is `laravel-poly-metrics` to log metrics for multiple models

[![Latest Version on Packagist](https://img.shields.io/packagist/v/emilhorlyck/laravel-poly-metrics.svg?style=flat-square)](https://packagist.org/packages/emilhorlyck/laravel-poly-metrics)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/emilhorlyck/laravel-poly-metrics/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/emilhorlyck/laravel-poly-metrics/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/emilhorlyck/laravel-poly-metrics/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/emilhorlyck/laravel-poly-metrics/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/emilhorlyck/laravel-poly-metrics.svg?style=flat-square)](https://packagist.org/packages/emilhorlyck/laravel-poly-metrics)

This package allows you to log metrics for multiple models, and even without relation to a models in laravel.

## Features

-   [x] Log metrics without relation to a model
    -   [x] Daily resolution
    -   [x] Monthly resolution
-   [x] Log metrics with relation to a model
    -   [x] Daily resolution
    -   [x] Monthly resolution
-   [x] Offer traits to easily log metrics on models
-   [ ] Offer command to purge old metrics
-   [ ] Offer command to purge old metrics for a specific model
-   [ ] Deafult scheduled command to purge old metrics

## Installation

You can install the package via composer:

```bash
composer require emilhorlyck/laravel-poly-metrics
```

You can publish all the necessary files with:

```bash
php artisan vendor:publish --provider="EmilHorlyck\PolyMetric\PolyMetricServiceProvider"
```

You can them run the migrations with:

```bash
php artisan migrate
```

## Usage

### Log metrics without relation to a model

```php

// Modify metrics with daily and monthly resolution
PolyMetric::set('my-metric', 42); // This will set the metric to 42
PolyMetric::increment('my-metric'); // This will increment the metric by 1
PolyMetric::decrement('my-metric'); // This will decrement the metric by 1

// Modify metrics with only daily resolution
PolyMetric::setDaily('my-metric', 42); // This will set the metric to 42
PolyMetric::incrementDaily('my-metric'); // This will increment the metric by 1
PolyMetric::decrementDaily('my-metric'); // This will decrement the metric by 1

// Modify metrics with only monthly resolution
PolyMetric::setMonthly('my-metric', 42); // This will set the metric to 42
PolyMetric::incrementMonthly('my-metric'); // This will increment the metric by 1
PolyMetric::decrementMonthly('my-metric'); // This will decrement the metric by 1

```

### Log metrics with relation to a model

Add the `HasMetrics` trait to your model.

```php
use EmilHorlyck\PolyMetric\Traits\HasMetrics;

class User extends Model
{
    use HasMetrics;
}
```

Log metrics on the model

```php
$user = User::find(1);

// Modify metrics with daily and monthly resolution
$user->setMetric('my-metric', 42); // This will set the metric to 42
$user->incrementMetric('my-metric'); // This will increment the metric by 1
$user->decrementMetric('my-metric'); // This will decrement the metric by 1

// Modify metrics with only daily resolution
$user->setDailyMetric('my-metric', 42); // This will set the metric to 42
$user->incrementDailyMetric('my-metric'); // This will increment the metric by 1
$user->decrementDailyMetric('my-metric'); // This will decrement the metric by 1

// Modify metrics with only monthly resolution
$user->setMonthlyMetric('my-metric', 42); // This will set the metric to 42
$user->incrementMonthlyMetric('my-metric'); // This will increment the metric by 1
$user->decrementMonthlyMetric('my-metric'); // This will decrement the metric by 1
```

## Credits

-   [Emil Hørlyck](https://github.com/emilhorlyck)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

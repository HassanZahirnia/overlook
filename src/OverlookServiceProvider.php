<?php

namespace Awcodes\Overlook;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class OverlookServiceProvider extends PackageServiceProvider
{
    public static string $name = 'overlook';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasTranslations()
            ->hasViews();
    }
}

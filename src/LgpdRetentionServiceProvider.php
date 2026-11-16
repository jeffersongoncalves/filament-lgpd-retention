<?php

namespace JeffersonGoncalves\Filament\LgpdRetention;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LgpdRetentionServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-lgpd-retention')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigrations();
    }
}

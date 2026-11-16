<?php

namespace JeffersonGoncalves\Filament\LgpdRetention;

use JeffersonGoncalves\FilamentPluginCore\BasePackageServiceProvider;
use Spatie\LaravelPackageTools\Package;

class LgpdRetentionServiceProvider extends BasePackageServiceProvider
{
    public static string $name = 'filament-lgpd-retention';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasTranslations();
    }
}

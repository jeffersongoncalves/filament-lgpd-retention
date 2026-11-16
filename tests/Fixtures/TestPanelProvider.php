<?php

namespace JeffersonGoncalves\Filament\LgpdRetention\Tests\Fixtures;

use Filament\Panel;
use Filament\PanelProvider;
use JeffersonGoncalves\Filament\LgpdRetention\LgpdRetentionPlugin;

class TestPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->plugins([
                LgpdRetentionPlugin::make(),
            ]);
    }
}

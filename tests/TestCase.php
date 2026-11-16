<?php

namespace JeffersonGoncalves\Filament\LgpdRetention\Tests;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Filament\Actions\ActionsServiceProvider;
use Filament\Facades\Filament;
use Filament\FilamentServiceProvider;
use Filament\Forms\FormsServiceProvider;
use Filament\Infolists\InfolistsServiceProvider;
use Filament\Notifications\NotificationsServiceProvider;
use Filament\Support\SupportServiceProvider;
use Filament\Tables\TablesServiceProvider;
use Filament\Widgets\WidgetsServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use JeffersonGoncalves\Filament\LgpdRetention\LgpdRetentionServiceProvider;
use JeffersonGoncalves\Filament\LgpdRetention\Tests\Fixtures\Customer;
use JeffersonGoncalves\Filament\LgpdRetention\Tests\Fixtures\TestPanelProvider;
use JeffersonGoncalves\Filament\LgpdRetention\Tests\Fixtures\TestUser;
use JeffersonGoncalves\Lgpd\LgpdServiceProvider;
use JeffersonGoncalves\LgpdRetention\LgpdRetentionServiceProvider as RetentionServiceProvider;
use JeffersonGoncalves\PestPluginDatabaseMigrations\LoadsPackageMigrations;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use RyanChandler\BladeCaptureDirective\BladeCaptureDirectiveServiceProvider;

abstract class TestCase extends Orchestra
{
    use LoadsPackageMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        Filament::setCurrentPanel(Filament::getDefaultPanel());

        $this->withoutVite();
    }

    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            BladeIconsServiceProvider::class,
            BladeHeroiconsServiceProvider::class,
            SupportServiceProvider::class,
            BladeCaptureDirectiveServiceProvider::class,
            FormsServiceProvider::class,
            TablesServiceProvider::class,
            ActionsServiceProvider::class,
            InfolistsServiceProvider::class,
            NotificationsServiceProvider::class,
            WidgetsServiceProvider::class,
            FilamentServiceProvider::class,
            LgpdServiceProvider::class,
            RetentionServiceProvider::class,
            LgpdRetentionServiceProvider::class,
            TestPanelProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('app.key', 'base64:'.base64_encode(str_repeat('a', 32)));
        $app['config']->set('database.default', 'testing');
        $app['config']->set('auth.providers.users.model', TestUser::class);
        $app['config']->set('lgpd.models', [TestUser::class, Customer::class]);
    }

    protected function defineDatabaseMigrations(): void
    {
        $this->loadPackageMigrations(RetentionServiceProvider::class);

        Schema::create('users', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->default('');
            $table->rememberToken();
        });

        Schema::create('customers', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }
}

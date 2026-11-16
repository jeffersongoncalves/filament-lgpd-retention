<div class="filament-hidden">

![Filament LGPD Retention](https://raw.githubusercontent.com/jeffersongoncalves/filament-lgpd-retention/1.x/art/jeffersongoncalves-filament-lgpd-retention.png)

</div>

# Filament LGPD Retention

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffersongoncalves/filament-lgpd-retention.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-lgpd-retention)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/filament-lgpd-retention/tests.yml?branch=1.x&label=tests&style=flat-square)](https://github.com/jeffersongoncalves/filament-lgpd-retention/actions?query=workflow%3Atests+branch%3A1.x)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/filament-lgpd-retention/fix-php-code-style-issues.yml?branch=1.x&label=code%20style&style=flat-square)](https://github.com/jeffersongoncalves/filament-lgpd-retention/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3A1.x)
[![Total Downloads](https://img.shields.io/packagist/dt/jeffersongoncalves/filament-lgpd-retention.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-lgpd-retention)
[![License](https://img.shields.io/packagist/l/jeffersongoncalves/filament-lgpd-retention.svg?style=flat-square)](LICENSE.md)

The Filament panel for [laravel-lgpd-retention](https://github.com/jeffersongoncalves/laravel-lgpd-retention). Under the LGPD (art. 15 and 16), personal data is eliminated once its retention period ends. This page lets you see what is due, run the retention, and erase again the data a restored backup brought back.

## Features

- **Preview:** how many records would be anonymized now, per model and column. Nothing is changed.
- **Apply retention:** anonymizes every column whose period has ended, each with its own strategy.
- **Re-apply after backup:** anonymizes again the columns that a restored backup brought back.
- The list of anonymized columns (tombstones), filterable by model and column. Tombstones hold no personal data.
- English and Brazilian Portuguese.

## Compatibility

| Plugin Version                                                                | Filament |
|-------------------------------------------------------------------------------|----------|
| [1.x](https://github.com/jeffersongoncalves/filament-lgpd-retention/tree/1.x) | 3.x      |
| [2.x](https://github.com/jeffersongoncalves/filament-lgpd-retention/tree/2.x) | 4.x      |
| [3.x](https://github.com/jeffersongoncalves/filament-lgpd-retention/tree/3.x) | 5.x      |

## Installation

You can install the package via composer:

```bash
composer require jeffersongoncalves/filament-lgpd-retention:"^1.0"
php artisan vendor:publish --tag="lgpd-retention-migrations"
php artisan migrate
```

## Usage

```php
use JeffersonGoncalves\Filament\LgpdRetention\LgpdRetentionPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            LgpdRetentionPlugin::make()
                ->navigationGroup('LGPD')             // default: no group
                ->navigationSort(30)
                ->navigationIcon('heroicon-o-clock')
                ->slug('data-retention'),
        ]);
}
```

All fluent methods are optional. The buttons run in the web request: keep `php artisan lgpd:retention` scheduled daily as the main way to apply retention, and use the panel to check and to act after a restore.

> The resource has no authorization of its own: register it only on panels whose users may erase personal data, or add a policy for `JeffersonGoncalves\LgpdRetention\Models\Tombstone`.

## Related plugins

- [filament-lgpd](https://github.com/jeffersongoncalves/filament-lgpd): personal data inventory, with each column's retention.
- [filament-lgpd-consent](https://github.com/jeffersongoncalves/filament-lgpd-consent): consent ledger.
- [filament-lgpd-dsar](https://github.com/jeffersongoncalves/filament-lgpd-dsar): data subject requests (art. 18).

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jefferson Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

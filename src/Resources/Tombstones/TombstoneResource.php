<?php

namespace JeffersonGoncalves\Filament\LgpdRetention\Resources\Tombstones;

use BackedEnum;
use Filament\Panel;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Relations\Relation;
use JeffersonGoncalves\Filament\LgpdRetention\LgpdRetentionPlugin;
use JeffersonGoncalves\Filament\LgpdRetention\Resources\Tombstones\Pages\ListTombstones;
use JeffersonGoncalves\LgpdRetention\Models\Tombstone;

/**
 * Tombstones hold no personal data: which column of which record was anonymized, and when.
 */
class TombstoneResource extends Resource
{
    protected static ?string $model = Tombstone::class;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('model_type')
                    ->label(__('filament-lgpd-retention::filament-lgpd-retention.fields.model'))
                    ->formatStateUsing(fn (string $state): string => static::modelLabel($state)),
                TextColumn::make('model_id')
                    ->label(__('filament-lgpd-retention::filament-lgpd-retention.fields.record'))
                    ->searchable(),
                TextColumn::make('column')
                    ->label(__('filament-lgpd-retention::filament-lgpd-retention.fields.column'))
                    ->fontFamily('mono'),
                TextColumn::make('created_at')
                    ->label(__('filament-lgpd-retention::filament-lgpd-retention.fields.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('model_type')
                    ->label(__('filament-lgpd-retention::filament-lgpd-retention.fields.model'))
                    ->options(fn (): array => Tombstone::query()->distinct()->orderBy('model_type')->pluck('model_type')
                        ->mapWithKeys(fn (string $type): array => [$type => static::modelLabel($type)])->all()),
                SelectFilter::make('column')
                    ->label(__('filament-lgpd-retention::filament-lgpd-retention.fields.column'))
                    ->options(fn (): array => Tombstone::query()->distinct()->orderBy('column')->pluck('column', 'column')->all()),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTombstones::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function modelLabel(string $type): string
    {
        return class_basename(Relation::getMorphedModel($type) ?? $type);
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-lgpd-retention::filament-lgpd-retention.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament-lgpd-retention::filament-lgpd-retention.resource.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-lgpd-retention::filament-lgpd-retention.resource.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return LgpdRetentionPlugin::get()->getNavigationGroup();
    }

    public static function getNavigationSort(): ?int
    {
        return LgpdRetentionPlugin::get()->getNavigationSort();
    }

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return LgpdRetentionPlugin::get()->getNavigationIcon();
    }

    public static function getSlug(?Panel $panel = null): string
    {
        return LgpdRetentionPlugin::get()->getSlug();
    }
}

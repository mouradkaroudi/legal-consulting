<?php

namespace App\Filament\Resources;

class NavigationResource extends \RyanChandler\FilamentNavigation\Filament\Resources\NavigationResource
{

    protected static function getNavigationLabel(): string
    {
        return static::$navigationLabel ?? static::$navigationLabel ?? __('filament::resources/navigations.label.plural');
    }

    public static function getPluralModelLabel(): string
    {
        return static::$pluralModelLabel ?? static::$pluralModelLabel ?? __('filament::resources/navigations.label.plural');
    }

    public static function getModelLabel(): string
    {
        return static::$modelLabel ?? static::$modelLabel ?? __('filament::resources/navigations.label.singular');
    }

}

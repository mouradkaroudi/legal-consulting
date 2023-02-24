<?php

namespace App\Providers;

use App\Filament\Resources\NavigationResource;
use Illuminate\Support\ServiceProvider;

class FilamentNavigationServiceProvider extends \RyanChandler\FilamentNavigation\FilamentNavigationServiceProvider
{
    protected array $resources = [
        NavigationResource::class,
    ];
}

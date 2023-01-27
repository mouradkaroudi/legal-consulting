<?php
// config for RyanChandler/FilamentNavigation

// use RyanChandler\FilamentNavigation\Filament\Resources\NavigationResource;

use App\Filament\Resources\CountryResource;

return [
    'navigation_model' => \RyanChandler\FilamentNavigation\Models\Navigation::class,
    'navigation_resource' => CountryResource::class,
];
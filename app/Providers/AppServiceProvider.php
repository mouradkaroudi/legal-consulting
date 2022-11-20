<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Filament\Facades\Filament::serving(function () {
            
            \Filament\Facades\Filament::registerNavigationGroups([
                \Filament\Navigation\NavigationGroup::make('Entities'),
                \Filament\Navigation\NavigationGroup::make('Appearance'),
                \Filament\Navigation\NavigationGroup::make('Finance'),
            ]);

            \RyanChandler\FilamentNavigation\Filament\Resources\NavigationResource::navigationGroup('Appearance');

        });

    }
}

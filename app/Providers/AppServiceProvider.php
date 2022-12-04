<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Illuminate\Foundation\Vite;

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
		Filament::serving(function () {
			Filament::registerViteTheme("resources/css/filament.css");
			Filament::registerNavigationGroups([
				\Filament\Navigation\NavigationGroup::make("Entities"),
				\Filament\Navigation\NavigationGroup::make("Appearance"),
				\Filament\Navigation\NavigationGroup::make("Finance"),
			]);

			\RyanChandler\FilamentNavigation\Filament\Resources\NavigationResource::navigationGroup(
				"Appearance"
			);
		});
	}
}

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
				\Filament\Navigation\NavigationGroup::make(__("Content Management")),
				\Filament\Navigation\NavigationGroup::make("Users & Offices"),
				\Filament\Navigation\NavigationGroup::make("Financial Management"),
			]);

			\RyanChandler\FilamentNavigation\Facades\FilamentNavigation::addItemType(__('Service'), [
				\Filament\Forms\Components\Select::make('service_id')
					->label(__('filament::resources/navigations.form.fields.service_id.singular'))
					->searchable()
					->options(function () {
						return \App\Models\Service::pluck('name', 'id');
					})
			]);

			\RyanChandler\FilamentNavigation\Facades\FilamentNavigation::addItemType(__('Profession'), [
				\Filament\Forms\Components\Select::make('profession_id')
					->label(__('filament::resources/navigations.form.fields.profession_id.singular'))
					->searchable()
					->options(function () {
						return \App\Models\Profession::pluck('name', 'id');
					})
			]);
		});
	}
}

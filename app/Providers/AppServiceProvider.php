<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\App;

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
				\Filament\Navigation\NavigationGroup::make(__("Users & Offices")),
				\Filament\Navigation\NavigationGroup::make(__("Financial Management")),
			]);
			
			\RyanChandler\FilamentNavigation\Filament\Resources\NavigationResource::navigationGroup(__('Content Management'));
			\RyanChandler\FilamentNavigation\Filament\Resources\NavigationResource::pluralLabel(__('filament::resources/navigations.label.plural'));
			\RyanChandler\FilamentNavigation\Filament\Resources\NavigationResource::label(__('filament::resources/navigations.label.singular'));
			

			\RyanChandler\FilamentNavigation\Facades\FilamentNavigation::addItemType(__('Service'), [
				\Filament\Forms\Components\Select::make('service_id')
					->label(__('filament::resources/navigations.form.fields.service_id.singular'))
					->searchable()
					->options(function () {
						return \App\Models\ServiceTranslation::pluck('name', 'id');
					})
			]);

			\RyanChandler\FilamentNavigation\Facades\FilamentNavigation::addItemType(__('Profession'), [
				\Filament\Forms\Components\Select::make('profession_id')
					->label(__('filament::resources/navigations.form.fields.profession_id.singular'))
					->searchable()
					->options(function () {
						return \App\Models\ProfessionTranslation::pluck('name', 'id');
					})
			]);
		});
	}
}

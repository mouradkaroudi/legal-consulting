<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
	public $bindings = [
		\RyanChandler\FilamentNavigation\FilamentNavigationManager::class => \App\Overrides\FilamentNavigationManager::class,
	];

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
					->label(__('filament::resources/navigations.form.fields.service_id.label'))
					->searchable()
					->options(function () {
						return \App\Models\ServiceTranslation::pluck('name', 'id');
					})
			], 'service');

			\RyanChandler\FilamentNavigation\Facades\FilamentNavigation::addItemType(__('Profession'), [
				\Filament\Forms\Components\Select::make('profession_id')
					->label(__('filament::resources/navigations.form.fields.profession_id.label'))
					->searchable()
					->options(function () {
						return \App\Models\ProfessionTranslation::pluck('name', 'id');
					})
			], 'profession');

			\RyanChandler\FilamentNavigation\Facades\FilamentNavigation::addItemType(__('Page'), [
				\Filament\Forms\Components\Select::make('page_id')
					->label(__('filament::resources/navigations.form.fields.page_id.label'))
					->searchable()
					->options(function () {

						$posts = \App\Models\Post::where('post_type', \App\Models\Post::TYPE_PAGE)->get();
						$options = $posts->each(function($post){
							return ['id' => $post->id, 'name' => $post->translation->title];
						});
						return $options->pluck('title','id');
					})
			], 'page');
		});
	}
}

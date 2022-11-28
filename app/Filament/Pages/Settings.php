<?php

namespace App\Filament\Pages;

use Filament\Forms\Components;
use App\Models\Setting;
use Filament\Pages\Page;

class Settings extends Page
{
	protected static ?string $navigationIcon = "heroicon-o-document-text";
	protected static ?string $navigationLabel = "اعدادات الموقع";
	protected static ?string $pluralModelLabel = "اعدادات الموقع";
	protected static ?string $title = "اعدادات الموقع";

	protected static string $view = "filament.pages.settings";

	public function mount()
	{
		$settings = Setting::all()->pluck('value', 'option')->toArray();
        
        $this->form->fill($settings);
	}

	protected function getBreadcrumbs(): array
	{
		return [
			url()->current() => "اعدادات",
		];
	}

    public function submit()
    {
        $settings = $this->form->getState();
        foreach( $settings as $option=>$value ) {
            Setting::where('option', $option)->update([
                'value' => $value
            ]);
        }
    }

	protected function getFormSchema(): array
	{
		$digitalOfficeSettingsScheme = [
            Components\Grid::make(2)->schema([
                Components\TextInput::make("digital_office_registration_fee")->label(
                    "رسوم التسجيل"
                ),
                Components\Toggle::make("digital_office_direct_registration")->label(
                    "تسجيل مباشر"
                ),
            ])
		];

		$orderSettingsScheme = [
            Components\Grid::make(3)->schema([
                Components\TextInput::make("order_min_fee")->label('الحد الأدنى للرسوم'),
                Components\TextInput::make("order_max_fee")->label('الحد الأقصى للرسوم'),
                Components\TextInput::make("order_percentage_fee")->label('نسبة الرسوم'),    
            ])
		];

		$registrationSettingsScheme = [
			Components\Toggle::make("registration_open")->label('التسجيل مفتوح'),
		];

		return [
			Components\Fieldset::make("digital_office")
				->label("إعدادت المكاتب")
				->schema($digitalOfficeSettingsScheme),
			Components\Fieldset::make("order")
				->label("إعدادت الطلبات")
				->schema($orderSettingsScheme),
			Components\Fieldset::make("order")
				->label("إعدادت التسجيل")
				->schema($registrationSettingsScheme),
		];
	}
}

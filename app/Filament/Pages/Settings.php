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
		$settings = Setting::all()
			->pluck("value", "option")
			->toArray();

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
		foreach ($settings as $option => $value) {
			Setting::where("option", $option)->updateOrCreate([
				"option" => $option,
				"value" => $value,
			]);
		}
	}

	protected function getFormSchema(): array
	{
		$digitalOfficeSettingsScheme = [
			Components\Grid::make(2)->schema([
				Components\Toggle::make("digital_office_direct_registration")->label(
					"تسجيل مباشر"
				)->helperText('تسجيل مكتب وظهوره في الموقع دون الحاجة لموافقة ادارة الموقع.'),
				Components\Toggle::make("digital_office_hide_unsubscribed_offices")->label(
					"حجب المكاتب غير مشتركة"
				)->helperText('سيتم حجب كل المكاتب غير مشتركة او انتهت مدة اشتراكها. (هذه الخاصية تعمل اذا اكانت خاصية الإشتراكات مفعلة)'),
			]),
		];

		$subscriptionsSettingsScheme = [
			Components\Grid::make(2)->schema([
				Components\Toggle::make("subscriptions_enable_subscription")->label(
					"تفعيل الإشتراك للمكاتب"
				)->helperText('سيتم طلب من مكتب دفع رسوم اشتراك على حسب المهنة التي يمارسها.'),
			]),
		];


		$registrationSettingsScheme = [
			Components\Toggle::make("registration_open")->label("التسجيل مفتوح"),
		];

		$paymentSettingScheme = [
			Components\Toggle::make("transactions_bank_transfer")->label(
				"استقبال التحويلات البكنية"
			)
			->reactive(),
			Components\TextInput::make("transactions_bank_rib")
				->label("رقم معرف الحساب البنكي")
				->helperText("رقم الحساب البنكي الذي تريد استقبال الحولات فيه.")
				->reactive()
				->hidden(fn ($state, callable $get) => $get('transactions_bank_transfer') == 0)
				->helperText("رقم الحساب البنكي الذي تريد استقبال الحولات فيه."),
		];

		return [
			Components\Fieldset::make("digital_office")
				->label("إعدادت المكاتب")
				->schema($digitalOfficeSettingsScheme),
			Components\Fieldset::make("subscriptions")
				->label("إعدادت الإشتراك")
				->schema($subscriptionsSettingsScheme),
			//Components\Fieldset::make("order")
				//->label("إعدادت الطلبات")
				//->schema($orderSettingsScheme),
			Components\Fieldset::make("order")
				->label("إعدادت التسجيل")
				->schema($registrationSettingsScheme),
			Components\Fieldset::make("payment")
				->label("إعدادت الدفع")
				->schema($paymentSettingScheme)->columns(1),
		];
	}
}

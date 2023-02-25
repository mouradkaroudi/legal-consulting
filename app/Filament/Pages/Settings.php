<?php

namespace App\Filament\Pages;

use App\Models\Post;
use Filament\Forms\Components;
use App\Models\Setting;
use Filament\Pages\Page;

class Settings extends Page
{

	protected static ?string $navigationIcon = "heroicon-o-document-text";

	protected static function getNavigationLabel(): string
	{
		return static::$navigationLabel ?? static::$title ?? __('filament::pages/settings.title');
	}

	protected static string $view = "filament.pages.settings";
	public static array $translatableAttributes = ['general_settings_site_name'];

	public function mount()
	{
		$settings = Setting::all()
			->pluck("value", "option")
			->toArray();

		$currentLocal = app()->getLocale();

		foreach ($settings as $option => $value) {

			$mayTranslatable = str_replace('_' . $currentLocal, '', $option);


			if (in_array($mayTranslatable, self::$translatableAttributes)) {
				$option = $mayTranslatable;
				$settings[$option] = $value;
			}

			if (json_decode($value) !== null) {
				$settings[$option] = json_decode($value, true);
			}
		}

		$this->form->fill($settings);
	}

	public function submit()
	{
		$settings = $this->form->getState();

		$currentLocal = app()->getLocale();

		foreach ($settings as $option => $value) {

			if (!is_string($value)) {
				$value = json_encode($value);
			}

			if (in_array($option, self::$translatableAttributes)) {
				$option = $option . '_' . $currentLocal;
			}

			Setting::where("option", $option)->updateOrCreate([
				"option" => $option,
			], [
				"value" => $value
			]);
		}
	}

	protected function getFormSchema(): array
	{

		$whatsappSettings = [
			Components\TextInput::make("whatsapp_number")
			->label(__('filament::pages/settings.fields.whatsapp.fields.number.label'))
		];

		$linksSettings = [
			Components\Select::make("links_privacy_page")
			->label(__('filament::pages/settings.fields.links.fields.privacy_page.label'))
			->options(Post::where('post_type', Post::TYPE_PAGE)->get()->pluck('title', 'id'))
		];

		$homepageSettings = [
			Components\Grid::make(2)->schema([
				Components\ColorPicker::make("homepage_whatsapp_textcolor")->label(
					__('filament::pages/settings.fields.homepage.fields.wstextcolor.label')
				),
				Components\ColorPicker::make("homepage_whatsapp_bgcolor")->label(
					__('filament::pages/settings.fields.homepage.fields.wsbgcolor.label')
				),
				Components\ColorPicker::make("homepage_cta_textcolor")->label(
					__('filament::pages/settings.fields.homepage.fields.text_color.label')
				),
				Components\ColorPicker::make("homepage_cta_bgcolor")->label(
					__('filament::pages/settings.fields.homepage.fields.bg_color.label')
				),
			]),
		];


		$generalSettings = [
			Components\Grid::make(2)->schema([
				Components\FileUpload::make("general_settings_site_logo")->label(
					__('filament::pages/settings.fields.general_settings.fields.site_logo.label')
				),
				Components\TextInput::make("general_settings_site_name")->label(
					__('filament::pages/settings.fields.general_settings.fields.site_name.label')
				),
				Components\RichEditor::make('general_settings_company_address')->label(
					__('filament::pages/settings.fields.general_settings.fields.company_address.label')
				)
			]),
		];

		$socialLinksSchema = [
			Components\Repeater::make('social_links')
				->label(__('filament::pages/settings.fields.social.fields.social_links.label'))
				->schema([
					Components\TextInput::make('link')
						->label(__('filament::pages/settings.fields.social.fields.social_links.fields.link.label')),
					Components\Select::make('platform')
						->label(__('filament::pages/settings.fields.social.fields.social_links.fields.platform.label'))
						->options([
							'facebook' => __('Facebook'),
							'whatsapp' => __('Whatsapp'),
							'instagram' => __('Instagram'),
							'telegram' => __('Telegram'),
							'twitter' => __('Twitter'),
							'tiktok' => __('Tiktok'),
							'snapchat' => __('Snapchat'),
						]),
				])
		];

		$digitalOfficeSettingsScheme = [
			Components\Grid::make(2)->schema([
				Components\Toggle::make("digital_office_direct_registration")->label(
					__('filament::pages/settings.fields.digital_office.fields.direct_registration.label')
				)->helperText(__('filament::pages/settings.fields.digital_office.fields.direct_registration.helperText')),
				Components\Toggle::make("digital_office_hide_unsubscribed_offices")->label(
					__('filament::pages/settings.fields.digital_office.fields.hide_unsubscribed_offices.label')
				)->helperText(__('filament::pages/settings.fields.digital_office.fields.hide_unsubscribed_offices.helperText')),
			]),
		];

		$subscriptionsSettingsScheme = [
			Components\Grid::make(2)->schema([
				Components\Toggle::make("subscriptions_enable_subscription")->label(
					__('filament::pages/settings.fields.subscriptions.fields.enable_subscription.label')
				)->helperText(__('filament::pages/settings.fields.subscriptions.fields.enable_subscription.helperText')),
			]),
		];


		$registrationSettingsScheme = [
			Components\Toggle::make("registration_open")
				->label(__('filament::pages/settings.fields.registration.fields.registration_open.label')),
		];

		$paymentSettingScheme = [
			Components\TextInput::make("tax")->numeric()
			->label(__('filament::pages/settings.fields.payment.fields.tax.label')),
			Components\Toggle::make("transactions_bank_transfer")
				->label(__('filament::pages/settings.fields.payment.fields.bank_transfer.label'))
				->reactive(),
			Components\TextInput::make("transactions_bank_rib")
				->label(__('filament::pages/settings.fields.payment.fields.bank_rib.label'))
				->label(__('filament::pages/settings.fields.payment.fields.bank_rib.helperText'))
				->reactive()
				->hidden(fn ($state, callable $get) => $get('transactions_bank_transfer') == 0)
		];

		return [
			Components\Fieldset::make("general_settings")
				->label(__('filament::pages/settings.fields.general_settings.label'))
				->schema($generalSettings),
			Components\Fieldset::make("digital_office")
				->label(__('filament::pages/settings.fields.digital_office.label'))
				->schema($digitalOfficeSettingsScheme),
			Components\Fieldset::make("subscriptions")
				->label(__('filament::pages/settings.fields.subscriptions.label'))
				->schema($subscriptionsSettingsScheme),
			Components\Fieldset::make("registration")
				->label(__('filament::pages/settings.fields.registration.label'))
				->schema($registrationSettingsScheme),
			Components\Fieldset::make("payment")
				->label(__('filament::pages/settings.fields.payment.label'))
				->schema($paymentSettingScheme)->columns(1),
			Components\Fieldset::make("homepage")
				->label(__('filament::pages/settings.fields.homepage.label'))
				->schema($homepageSettings)->columns(1),
			Components\Fieldset::make("whatsapp")
				->label(__('filament::pages/settings.fields.whatsapp.label'))
				->schema($whatsappSettings)->columns(1),
			Components\Fieldset::make("links")
				->label(__('filament::pages/settings.fields.links.label'))
				->schema($linksSettings)->columns(1),
			Components\Fieldset::make("social")
				->label(__('filament::pages/settings.fields.social.label'))
				->schema($socialLinksSchema)->columns(1),
		];
	}
}

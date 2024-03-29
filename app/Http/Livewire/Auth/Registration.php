<?php

namespace App\Http\Livewire\Auth;

use App\Services\AuthService;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Registration extends Component implements HasForms
{
	use InteractsWithForms;

	public $inviteToken = null;
	public $account_type;
	public $name;
	public $email;
	public $password;
	public $password_confirmation;
	public $terms;

	protected function getFormSchema(): array
	{

		$fields = [
			TextInput::make("name")
				->label(__("validation.attributes.name"))
				->required(),
			TextInput::make("email")
				->email()
				->label(__("validation.attributes.email"))
				->required()
				->unique("users"),
			TextInput::make("password")
				->password()
				->label(__("validation.attributes.password"))
				->required()
				->confirmed(),
			TextInput::make("password_confirmation")
				->password()
				->label(__("validation.attributes.password_confirmation"))
				->required(),
			get_privacy_checkbox(),
		];

		if (!empty($this->inviteToken)) {
			$fields[] = Hidden::make("inviteToken");
		} else {
			array_unshift(
				$fields,
				Radio::make("account_type")
					->label(__('Choose the account type'))
					->options([
						"beneficiary" => __('Beneficiary'),
						"provider" => __('Service provider'),
					])
					->descriptions([
						"beneficiary" => __('Benefit from services and advice'),
						"provider" => __('Providing services and consulting'),
					])
					->required()
			);
		}

		return $fields;
	}

	public function submit()
	{

		$this->validate();

		if ($this->account_type === 'provider') {
			$user = AuthService::registerServiceProvider($this->name, $this->email, $this->password);
		} else {
			$user = AuthService::registerUser($this->name, $this->email, $this->password, $this->inviteToken);
		}

		Auth::loginUsingId($user->id);


		return redirect()->route("account.settings");
	}

	public function render()
	{
		return view("livewire.auth.registration");
	}
}

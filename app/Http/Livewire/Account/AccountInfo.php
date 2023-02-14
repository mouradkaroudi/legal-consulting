<?php

namespace App\Http\Livewire\Account;

use App\Models\Country;
use App\Models\User;
use Livewire\Component;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Illuminate\Validation\Rule;

class AccountInfo extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public User $user;

    public function mount($user)
    {
        $this->form->fill([
            'name' => $user->name,
            'email' => $user->email,
            'avatar_url' => $user->avatar_url,
            'preferred_lang' => $user->preferred_lang,
            'address' => $user->address,
            'ID_number' => $user->ID_number,
            'ID_image' => $user->ID_image,
            'driving_license_image' => $user->driving_license_image,
            'country_id' => $user->country_id,
        ]);
    }

    private function updateProfile($data)
    {
        $email = $data['email'];
        $name = $data['name'];
        $avatar_url = $data['avatar_url'];
        $preferred_lang = $data['preferred_lang'];
        $address = $data['address'];
        $ID_number = $data['ID_number'];
        $ID_image = $data['ID_image'];
        $driving_license_image = $data['driving_license_image'];
        $country_id = $data['country_id'];

        $this->user->email = $email;
        $this->user->name = $name;
        $this->user->avatar_url = $avatar_url;
        $this->user->preferred_lang = $preferred_lang;
        $this->user->address = $address;
        $this->user->ID_number = $ID_number;
        $this->user->ID_image = $ID_image;
        $this->user->driving_license_image = $driving_license_image;
        $this->user->country_id = $country_id;

        $this->user->save();
        redirect()->route("account.settings");
    }

    public function submit()
    {
        $data = $this->form->getState();
        $this->updateProfile($data);
    }

    protected function getFormSchema(): array
    {
        $citizenships = Country::all()->pluck("citizenship", "id");

        return [
            Grid::make(2)->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('validation.attributes.name'))
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label(__('validation.attributes.email'))
                    ->email()
                    ->unique('users', 'email', $this->user)
                    ->required(),
            ]),
            Grid::make(2)->schema([
                Forms\Components\FileUpload::make('avatar_url')
                    ->label(__('validation.attributes.avatar_url')),
                Forms\Components\Select::make('preferred_lang')
                    ->label(__('validation.attributes.language'))
                    ->options([
                        'ar' => 'العربية',
                        'en' => 'English'
                    ]),
            ]),
            Forms\Components\TextInput::make('ID_number')
                ->label(__('validation.attributes.ID'))
                ->unique()
                ->required(),
            Forms\Components\TextInput::make('address')
                ->label(__('validation.attributes.address'))
                ->required(),
            Forms\Components\FileUpload::make('ID_image')
                ->label(__('validation.attributes.ID_image'))
                ->required(),
            Forms\Components\FileUpload::make('driving_license_image')
                ->label(__('Driving license image'))
                ->required(),
            Forms\Components\Select::make("country_id")
                ->label(__('validation.attributes.nationality'))
                ->options($citizenships)
        ];
    }

    public function render()
    {
        return view('livewire.account.account-info');
    }
}

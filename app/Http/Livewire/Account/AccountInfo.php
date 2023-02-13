<?php

namespace App\Http\Livewire\Account;

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
            'address' => $user->address
        ]);
    }

    private function updateProfile($data)
    {
        $email = $data['email'];
        $name = $data['name'];
        $avatar_url = $data['avatar_url'];
        $preferred_lang = $data['preferred_lang'];
        $address = $data['address'];

        $this->user->email = $email;
        $this->user->name = $name;
        $this->user->avatar_url = $avatar_url;
        $this->user->preferred_lang = $preferred_lang;
        $this->user->address = $address;

        $this->user->save();
        redirect()->route("account.settings");
    }

    public function submit()
    {

        $this->validate([
            'name' => 'required|string|min:6',
            'address' => 'required|string|min:6',
            'email' => ['sometimes', Rule::unique('users')->ignore($this->user->id)],
        ]);

        $data = $this->form->getState();
        $this->updateProfile($data);
    }

    protected function getFormSchema(): array
    {
        // TODO: add ID image, number(*); phone number, walk license image , drive license image
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
            Forms\Components\TextInput::make('address')
            ->label(__('validation.attributes.address'))
            ->required(),
        ];
    }

    public function render()
    {
        return view('livewire.account.account-info');
    }
}

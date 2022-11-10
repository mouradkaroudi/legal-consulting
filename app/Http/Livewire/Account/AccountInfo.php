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

    public function mount($user) {
        $this->form->fill([
            'name' => $user->name,
            'email' => $user->email,
            'avatar_url' => $user->avatar_url
        ]);
    }

    private function updateProfile( $data ) {
        
        $email = $data['email'];
        $name = $data['name'];
        $avatar_url = $data['avatar_url'];

        $this->user->email = $email;
        $this->user->name = $name;
        $this->user->avatar_url = $avatar_url;

        $this->user->save();

    }

    public function submit() {
        
        $this->validate([
            'name' => 'required|string|min:6',
            'email' => ['sometimes', Rule::unique('users')->ignore($this->user->id)],
        ]);

        $data = $this->form->getState();
        $this->updateProfile($data);
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make(2)->schema([
                Forms\Components\TextInput::make('name')
                    ->label('الإسم')
                    ->label(__('validation.attributes.name'))->required(),
                Forms\Components\TextInput::make('email')
                    ->label(__('validation.attributes.email'))
                    ->email()
                    ->unique('users', 'email', $this->user)
                    ->required(),
            ]),
            Grid::make(2)->schema([
                Forms\Components\FileUpload::make('avatar_url')
                    ->label('الصورة الشخصية')
                ,
            ]),
        ];
    }

    public function render()
    {
        return view('livewire.account.account-info');
    }
}
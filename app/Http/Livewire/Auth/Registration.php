<?php

namespace App\Http\Livewire\Auth;

use App\Models\DigitalOffice;
use App\Models\DigitalOfficeEmployee;
use App\Models\User;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Registration extends Component implements HasForms
{
    use InteractsWithForms;

    public $account_type;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $terms;

    protected function getFormSchema(): array
    {
        return [
            Radio::make('account_type')
                ->label('إختر نوع الحساب')
                ->options([
                    'beneficiary' => 'مستفيد',
                    'provider' => 'مقدم خدمة',
                ])
                ->descriptions([
                    'beneficiary' => 'الإستفادة من خدمات و استشارات',
                    'provider' => 'تقديم الخدمات و الإستشارات'
                ])->required(),
            TextInput::make('name')->label(__('validation.attributes.name'))->required(),
            TextInput::make('email')->email()->label(__('validation.attributes.email'))->required()->unique('users'),
            TextInput::make('password')->password()->label(__('validation.attributes.password'))->required()->confirmed(),
            TextInput::make('password_confirmation')->password()->label(__('validation.attributes.password_confirmation'))->required(),
            Checkbox::make('terms')->label('أوفق على شروط الإستخدام')->inline()->required()
        ];
    }

    private function register( $data )
    {

        $account_type = $data['account_type'];
        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        if ($account_type === 'provider') {

            $officeOwnerRole = Role::findByName('OfficeOwner');
            $user_id = $user->id;
            $user->assignRole($officeOwnerRole);

            $digitalOffice = DigitalOffice::create([
                'name' => ''
            ]);

            DigitalOfficeEmployee::create([
                'user_id' => $user_id,
                'office_id' => $digitalOffice->id,
                'role_name' => 'مدير'
            ]);

            Auth::loginUsingId($user->id);

            if($account_type == 'beneficiary') {
                route('account');
            }else{
                route('dashboardsettings.index');
            }

        }
    }

    public function submit()
    {
        $data = $this->form->getState();
        $this->register($data);
    }

    public function render()
    {
        return view('livewire.auth.registration');
    }
}

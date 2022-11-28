<?php

namespace App\Http\Livewire\Auth;

use App\Models\DigitalOffice;
use App\Models\DigitalOfficeEmployee;
use App\Models\Invite;
use App\Models\Profile;
use App\Models\User;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Hidden;
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
            TextInput::make('name')->label(__('validation.attributes.name'))->required(),
            TextInput::make('email')->email()->label(__('validation.attributes.email'))->required()->unique('users'),
            TextInput::make('password')->password()->label(__('validation.attributes.password'))->required()->confirmed(),
            TextInput::make('password_confirmation')->password()->label(__('validation.attributes.password_confirmation'))->required(),
            Checkbox::make('terms')->label('أوفق على شروط الإستخدام')->inline()->required()
        ];

        if(!empty($this->inviteToken)) {
            $fields[] = Hidden::make('inviteToken');
        }else{
            array_unshift($fields, 
                Radio::make('account_type')
            ->label('إختر نوع الحساب')
            ->options([
                'beneficiary' => 'مستفيد',
                'provider' => 'مقدم خدمة',
            ])
            ->descriptions([
                'beneficiary' => 'الإستفادة من خدمات و استشارات',
                'provider' => 'تقديم الخدمات و الإستشارات'
            ])->required());
        }

        return $fields;
    }

    private function register( $data )
    {
    
        $account_type = isset($data['account_type']) ? $data['account_type'] : null;
        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];
        $inviteToken = isset($data['inviteToken']) && !empty($data['inviteToken']) ? $data['inviteToken'] : null;

        $invite = Invite::where('token', $inviteToken)->first();

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        if(!empty($invite)) {
            
            $employee = DigitalOfficeEmployee::create([
                'office_id' => $invite->office_id,
                'user_id' => $user->id
            ]);

            $employee->assignRole('OfficeEmployee');

            Profile::create([
                'user_id' => $user->id
            ]);

        }else{
            if ($account_type === 'provider') {

                $profile = new Profile;
                $profile->user_id = $user->id;
                $profile->save();

                $digitalOffice = DigitalOffice::create([
                    'user_id' => $user->id,
                    'name' => 'مكتب ' . $user->name
                ]);
    
                return $digitalOffice;
            }
        }

        Auth::loginUsingId($user->id);

    }

    public function submit()
    {
        $data = $this->form->getState();
        $register = $this->register($data);
        if(!empty($register)) {
            return redirect()->to('/account/settings');
        }
    }

    public function render()
    {
        return view('livewire.auth.registration');
    }
}

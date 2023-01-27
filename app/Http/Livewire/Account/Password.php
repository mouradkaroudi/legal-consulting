<?php

namespace App\Http\Livewire\Account;

use App\Models\User;
use Closure;
use Livewire\Component;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Password extends Component implements Forms\Contracts\HasForms
{
  use Forms\Concerns\InteractsWithForms;

  public $password;
  public $current_password;
  public $password_confirmation;
  
  private function updatePassword( $password )
  {
    $user = Auth::user();
    $user->password = Hash::make( $password );
    $user->save();
  }

  public function submit()
  {
    $data = $this->form->getState();

    $this->updatePassword($data['password']);

  }

  protected function getFormSchema(): array
  {
    return [
      Grid::make(1)->schema([
        Forms\Components\TextInput::make("current_password")
          ->label(__("validation.attributes.current_password"))
          ->rules([
            function () {
                return function (string $attribute, $value, Closure $fail) {
                    if(!Hash::check($value, Auth::user()->password)) {
                        return $fail(__("validation.current_password"));
                    }    
                };
            },        
          ])
          ->password()
          ->required(),
      ]),
      Grid::make(2)->schema([
        Forms\Components\TextInput::make("password")
          ->password()
          ->label(__("validation.attributes.password"))
          ->required()
          ->confirmed(),
        Forms\Components\TextInput::make("password_confirmation")
          ->password()
          ->label(__("validation.attributes.password_confirmation"))
          ->required(),
      ]),
    ];
  }

  public function render()
  {
    return view("livewire.account.password");
  }
}

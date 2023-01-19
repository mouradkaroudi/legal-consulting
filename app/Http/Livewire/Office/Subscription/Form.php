<?php

namespace App\Http\Livewire\Office\Subscription;

use App\Models\ProfessionSubscriptionPlan;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Suleymanozev\FilamentRadioButtonField\Forms\Components\RadioButton;

class Form extends Component implements HasForms
{

    use InteractsWithForms;

    public $digitalOffice;
    public $plan_id;
    public $agree;

    public function mount() {
        $this->digitalOffice = auth()->user()->currentOffice;
    }

    public function submit() {
        $data = $this->form->getState();

        return redirect()->route('office.subscription.pay', ['profession_subscription_plan' => $this->plan_id]);
        
    }

    protected function getFormSchema(): array
    {

        $plans = ProfessionSubscriptionPlan::where('profession_id', $this->digitalOffice->profession_id)->get();

        return [
            RadioButton::make('plan_id')->options(function() use ($plans) {
                return $plans->pluck('fee_label', 'id');
            })->descriptions(function() use ($plans) {
                return $plans->pluck('name', 'id');
            })->label(false)->required(),
            Checkbox::make('agree')->label('أوافق على شروط إستخدام الموقع.')->required()
        ];
    }

    public function render()
    {
        return view('livewire.office.subscription.form');
    }
}

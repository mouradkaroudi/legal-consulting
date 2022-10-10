<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Greeting extends Component
{
    public function render()
    {
        return <<<'blade'
            <div class="p-4 border rounded-md">
                <h1 class="text-3xl font-bold mb-3">صباح الخير, محمد </h1>
                <p class="text-gray-600 text-xl">في مايلي لوحة تحكم بآخر المواعيد المجدولة و الطلبات</p>
            </div>
        blade;
    }
}

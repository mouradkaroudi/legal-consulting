<?php

namespace App\Http\Livewire\Front\Widgets;

use App\Models\Category;
use Livewire\Component;

class ListCategories extends Component
{
    public function render()
    {

        $categories = Category::where('parent', 0)->limit(6)->get();

        return view('livewire.front.widgets.list-categories', ['categories' => $categories]);
    }
}

<?php

namespace App\Http\Livewire\Shared\Widgets;

use App\Models\Post;
use Livewire\Component;

class Faq extends Component
{

    public $posts = null;

    public function mount() {
        
        $this->posts = Post::where('post_type', Post::TYPE_FAQ)->get();

    }

    public function render()
    {
        return view('livewire.shared.widgets.faq');
    }
}

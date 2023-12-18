<?php

namespace App\Livewire\Main;

use Livewire\Component;

use Livewire\Attributes\{Layout, Title};
use App\Models\Post;

#[Title('Home page')]
#[Layout('layouts.main')]
class HomePage extends Component
{
    public $posts;

    public function mount()
    {
        $this->posts = Post::latest('updated_at')->take(3)->get();
    }

    public function render()
    {
        return view('livewire.main.home-page');
    }
}

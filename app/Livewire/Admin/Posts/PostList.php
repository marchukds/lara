<?php

namespace App\Livewire\Admin\Posts;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Posts List')]
class PostList extends Component
{
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.posts.post-list');
    }
}

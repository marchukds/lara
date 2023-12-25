<?php

namespace App\Livewire\Admin\Roles;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Roles List')]
#[Layout('layouts.admin')]
class RoleList extends Component
{
    public function render()
    {
        return view('livewire.admin.roles.role-list');
    }
}

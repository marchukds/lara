<?php

namespace App\Livewire\Admin\Users;

use App\Traits\RoleOrPermission;
use Livewire\Component;

class UserList extends Component
{
    use RoleOrPermission;

    public function __construct()   {
        $this->handlePermission('admin|manager');
    }

    public function render()
    {
        return view('livewire.admin.users.user-list');
    }
}

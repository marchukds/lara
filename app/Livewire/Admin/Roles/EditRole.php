<?php

namespace App\Livewire\Admin\Roles;

use App\Livewire\Forms\Admin\RoleForm;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\{Role, Permission};

#[Title('Edit Role')]
#[Layout('layouts.admin')]
class EditRole extends Component
{
    public RoleForm $form;
    public Array $permissions;


    public function mount(Role $role)
    {
        $this->permissions = Permission::all('id', 'name')->toArray();
        $this->form->setRole($role);
    }

    public function save()
    {
        $this->form->update();
        return $this->redirect('/admin/roles');
    }

    public function render()
    {
        return view('livewire.admin.roles.edit-role');
    }
}

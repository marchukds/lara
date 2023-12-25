<?php

namespace App\Livewire\Admin\Users;

use App\Livewire\Forms\Admin\UserForm;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Role;

#[Title('Edit User')]
class EditUser extends Component
{
    public Array $roles;
    public UserForm $form;

    public function mount(User $user)   {
        $this->form->setUser($user);
        $this->roles = Role::all('id', 'name')->toArray();
    }

    public function save()   {
        $this->form->update();
        return $this->redirect('/admin/users');
    }

    #[Layout('layouts.admin')]
    public function render()   {
        return view('livewire.admin.users.edit-user');
    }
}

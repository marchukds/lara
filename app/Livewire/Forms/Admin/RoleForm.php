<?php

namespace App\Livewire\Forms\Admin;

use App\Models\Tag;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Spatie\Permission\Models\{Role, Permission};

class RoleForm extends Form
{
    public ?Role $role;

    #[Validate('required|min:5')]
    public $name = '';

    #[Validate('required|array')]
    public array $permissions = [];

    public function setRole(Role $role)
    {
        $this->role = $role;
        $this->name = $role->name;
        $this->permissions = $role->permissions()->pluck('id')->toArray();
    }

    public function store()
    {
        $validated = $this->validate();
        Role::create($this->all());
    }

    public function update()
    {
        $validated = $this->validate();
        $this->role->update(
            $this->all()
        );
        $this->role->permissions()->sync($this->permissions);
    }
}

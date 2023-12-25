<?php

namespace App\Livewire\Forms\Admin;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user;

    #[Validate('required|min:5')]
    public $name = '';

    #[Validate('required|array')]
    public array $roles = [];

    public function setUser(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->roles = $user->roles()->pluck('id')->toArray();
    }

    public function store()
    {
        $validated = $this->validate();
        User::create($this->all());
    }

    public function update()
    {
        $validated = $this->validate();
        $this->user->update(
            $this->all()
        );
        $this->user->roles()->sync($this->roles);
    }
}

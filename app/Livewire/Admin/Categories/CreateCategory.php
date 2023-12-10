<?php

namespace App\Livewire\Admin\Categories;

use App\Livewire\Forms\Admin\CategoryForm;
use Livewire\Attributes\{Title, Layout};
use Livewire\Component;
use Livewire\WithFileUploads;


#[Title('Create Category')]
class CreateCategory extends Component
{
    use WithFileUploads;

    public CategoryForm $form;

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.categories.create-category');
    }

    public function save()
    {
        $this->form->store();
        return $this->redirect('/admin/categories');
    }
}

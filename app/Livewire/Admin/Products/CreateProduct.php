<?php

namespace App\Livewire\Admin\Products;

use App\Enums\ProductStatus;
use App\Livewire\Forms\Admin\ProductForm;
use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;

#[Title('Create New Product')]
class CreateProduct extends Component
{
    use WithFileUploads;

    public ProductForm $form;

    public array $categories;
    public array $brands;
    public array $productStatus;

    public function mount(): void
    {
        $this->categories = Category::all('id', 'name')->toArray();
        $this->brands = Brand::all('id', 'name')->toArray();
        $this->productStatus = ProductStatus::asArray();
    }

    public function save()
    {
        $this->form->store();
        return $this->redirect('/admin/products');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.products.create-product');
    }
}

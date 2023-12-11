<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Column;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use App\Livewire\Table;

class ProductTable extends Table
{
    public $routeEdit = 'products.edit';

    public function query(): Builder
    {
        return Product::query();
    }

    public function columns(): array
    {
        return [
            Column::make('name', 'Name'),
//            Column::make('status', 'Status')->component('columns.status'),
            Column::make('created_at', 'Created At')->component('columns.human-diff')
        ];
    }

    public function deleteItem(int $id): array
    {
        $category = Product::find($id);
        $category->delete();
        return $this->redirect('/admin/products');
    }
}

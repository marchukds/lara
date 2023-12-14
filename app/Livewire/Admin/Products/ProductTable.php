<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Column;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use App\Livewire\Table;

class ProductTable extends Table
{
    public string $searchQuery = '';

    public string $routeEdit = 'products.edit';

    public function query(): Builder
    {
        return Product::with('category')
            ->when(
                $this->searchQuery !== '',
                fn(Builder $query) => $query->where('name', 'like', '%' . $this->searchQuery . '%')
            );

    }

    public function updated($key): void
    {
        if ($key === 'searchQuery') {
            $this->resetPage();
        }
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'ID'),
            Column::make('name', 'Name'),
            Column::make('status', 'Status')->component('columns.status'),
            Column::make('created_at', 'Created At')->component('columns.human-diff')
        ];
    }

    public function deleteItem(int $id)
    {
        $product = Product::find($id);
        $product->delete();
        return $this->redirect('/admin/products');
    }

    public function restoreItem(int $id){
        Product::withTrashed()->where('id', $id)->restore();
    }

    public function forceDeleteItem(int $id){
        Product::withTrashed()->find($id)->forceDelete();
    }
}

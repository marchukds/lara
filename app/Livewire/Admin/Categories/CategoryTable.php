<?php

namespace App\Livewire\Admin\Categories;

use App\Livewire\Column;
use App\Livewire\Table;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class CategoryTable extends Table
{
    public string $searchQuery = '';

    public $routeEdit = 'categories.edit';

    public function query(): Builder
    {
        return Category::query()->when(
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

    public function deleteItem(int $id): array
    {
        $category = Category::find($id);
        $category->delete();
        return $this->redirect('/admin/categories');
    }

    public function restoreItem(int $id){
        Category::withTrashed()->where('id', $id)->restore();
    }

    public function forceDeleteItem(int $id){
        Category::withTrashed()->find($id)->forceDelete();
    }
}

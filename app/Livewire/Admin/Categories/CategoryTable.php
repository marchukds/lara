<?php

namespace App\Livewire\Admin\Categories;

use App\Livewire\Column;
use App\Livewire\Table;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class CategoryTable extends Table
{
    public $routeEdit = 'categories.edit';

    public function query(): Builder
    {
        return Category::query();
    }

    public function columns(): array
    {
        return [
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
}

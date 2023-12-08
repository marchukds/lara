<?php

namespace App\Livewire;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

abstract class Table extends Component
{
    use WithPagination;

    public int $perPage = 1;
    public int $page = 1;

    public abstract function query(): Builder;

    public abstract function columns(): array;

    public function data(): LengthAwarePaginator
    {
        return $this->query()->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.table');
    }
}

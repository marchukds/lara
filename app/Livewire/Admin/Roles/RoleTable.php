<?php

namespace App\Livewire\Admin\Roles;

use App\Models\Tag;
use Spatie\Permission\Models\{Role, Permission};
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\{BooleanColumn, ButtonGroupColumn, LinkColumn, ComponentColumn};

class RoleTable extends DataTableComponent
{
    protected $model = Role::class;
    public array $roles = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['roles.id as id']);
    }

    public function deleteItem($id)
    {
        $tag = Role::find($id);
        $tag->delete();
    }


    public function getTableRowUrl($row): string
    {
        return route('roles.edit', $row->id);
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),


            ButtonGroupColumn::make('Actions')
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Edit')
                        ->title(fn($row) => 'Edit ')
                        ->location(fn($row) => route('roles.edit', $row->id))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'underline text-blue-500 hover:no-underline',
                            ];
                        }),

                    LinkColumn::make('Delete')
                        ->title(fn($row) => 'Delete ')
                        ->location(fn($row) => url('#!'))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'underline text-red-500 hover:no-underline',
                                "wire:click" => "deleteItem($row->id)"
                            ];
                        }),

                ]),
        ];

    }
}

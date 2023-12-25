<div>

    <x-slot name="header">
        <div class="flex justify-between">
            <h1 class="text-3xl text-black pb-6">Roles management</h1>
        </div>
    </x-slot>


    <div class="flex flex-col min-w-0 flex-1 overflow-hidden">
        @livewire('admin.roles.role-table')
    </div>


</div>

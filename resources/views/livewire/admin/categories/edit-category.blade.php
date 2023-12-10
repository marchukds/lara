<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h1 class="text-3xl text-black pb-6">Edit Category</h1>
            <div class="flex">
                <x-button md href="">Not active categories</x-button>
                <x-button md href="" color="orange">Trashed categories</x-button>
            </div>
        </div>
    </x-slot>

    <form method="POST" wire:submit="save">
    </form>
</div>

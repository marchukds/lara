<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h1 class="text-3xl text-black pb-6">Edir User role</h1>
        </div>
    </x-slot>

    <x-errors title="Ops! There are :count validation errors:" color="orange" />

    <form method="POST" wire:submit="save">
        <div>
            <x-input label="Name *" hint="Insert role name" wire:model.blur="form.name" />
        </div>

        <div class="mt-4">
            <x-select.styled
                wire:model="form.roles"
                :options="$roles"
                select="label:name|value:id"
                multiple />
        </div>

        <div class="mt-4">
            <x-button text="Update Role" type="submit" color="blue" />
        </div>

    </form>
</div>

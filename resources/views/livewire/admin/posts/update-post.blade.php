<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h1 class="text-3xl text-black pb-6">Update post</h1>
            <div class="flex">
                <x-button md href="{{ route('posts.index') }}">All posts</x-button>
                <x-button md href="#" color="orange">Trashed products</x-button>
            </div>
        </div>
    </x-slot>

    <x-errors title="Ops! There are :count validation errors:" color="orange"/>

    <form method="POST" wire:submit="save">
        <div>
            <x-input label="Name *" hint="Insert post name" wire:model.blur="form.title"/>
        </div>
        <div class="mt-4">
            <x-textarea label="Content *" wire:model.blur="form.content"/>
        </div>

        <div class="mt-4">
            <h4>Product status</h4>
            <div class="inline-flex space-x-4">
                @foreach($postStatus as $key => $value)
                    <x-radio label="{{$key}}" value="{{$value}}" wire:model="form.status"/>
                @endforeach
            </div>
        </div>

        <div class="mt-4">

            <x-select.native label="Select One User"
                             hint="You can choose whoever you want"
                             wire:model="form.user_id"
                             :options="$users"
                             select="label:name|value:id">
            </x-select.native>
        </div>

        <div class="mt-4">
            <x-select.styled label="Select Some tags"
                             hint="You can choose whoever you want"
                             wire:model="form.tags"
                             :options="$tags"
                             select="label:name|value:id"
                             multiple
            />
        </div>

        <div class="flex items-center justify-center w-full mt-4">

            <label for="dropzone-file"
                   class="flex items-center justify-between w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">

                <div class="flex-1 flex-col items-center pt-5 pb-6">
                   <span class="inline-flex items-baseline">

                       @if ($form->oldCover)
                           <img src="{{ asset(Storage::url($form->oldCover)) }}" class="object-cover h-64">
                       @endif
                       {{----}}

                       @if ($form->cover)
                           <img src="{{ $form->cover->temporaryUrl() }}" class="object-cover h-64 overflow-hidden">
                       @endif
                    </span>
                </div>

                <div class="flex-1 flex-col items-center pt-5 pb-6">

                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                            class="font-semibold">Click to upload</span> or drag and drop</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                </div>

                <input id="dropzone-file" type="file" class="hidden" wire:model="form.cover"/>
            </label>
        </div>

        <div class="mt-4">
            <x-button text="Update Post" type="submit" color="blue"/>
        </div>
    </form>
</div>

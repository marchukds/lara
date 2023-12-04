<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-3xl text-black pb-6">Brands management</h2>
            <div class="flex">
                <a href="{{ route('brands.index') }}">
                    <x-admin.primary-button>
                        {{ __('All brands') }}
                    </x-admin.primary-button>
                </a>
            </div>
        </div>

        <div class="w-full mt-12">
            <p class="text-xl pb-3 flex items-center">
                <i class="fas fa-list mr-3">

                </i>
                Edit Brand {{ $brand->id }}
            </p>
            <div class="bg-white overflow-auto">
                <form class="p-10 bg-white rounded shadow-xl" action="{{ route('brands.update', $brand->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="">
                        <label class="block text-sm text-gray-600" for="name">Brand Name</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-100 rounded @error('name') is-invalid @enderror" id="name" name="name" type="text" value="{{old('name', $brand->name)}}"  aria-label="Name" autofocus autocomplete="name">
                        @error('name')<div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="">
                        <label class="block text-sm text-gray-600" for="name">Brand description</label>
                        <textarea class="w-full px-5 py-1 text-gray-700 bg-gray-100 rounded" id="description" name="description" placeholder="Enter brands description">{{ old('description', $brand->description) }}</textarea>
                        @error('description') <div class="alert alert-danger">{{ $message }}</div>  @enderror
                    </div>
                    <x-admin.submit-button class="ms-4"> {{ __('Update') }} </x-admin.submit-button>
                </form>
            </div>
        </div>
</x-admin-layout>

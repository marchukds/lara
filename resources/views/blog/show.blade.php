{{-- post --}}
<x-main-layout>
    <x-slot name="header">
        <h1>{{ $post->title }}</h1>
    </x-slot>

    <x-blog.details :post="$post">
    </x-blog.details>

    <x-slot name="footer">
        <p>
        <h2>&copy;2024</h2></p>
    </x-slot>
</x-main-layout>

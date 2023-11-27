{{-- post list --}}
<x-main-layout>
    <style>
        nav.flex svg {
            display: none;
        }
    </style>
    <x-slot name="header">
        <h1>Blog posts</h1>
    </x-slot>

    @forelse($posts as $post)
        <h2>{{$post->title}}</h2>
        <a href="blog/{{ $post->id }}">Reads more...</a>
    @empty
        <strong>Posts not fount</strong>
    @endforelse

    <hr>

    {{ $posts->links() }}

    <x-slot name="footer">
        <p><h2>&copy;2024</h2></p>
    </x-slot>
</x-main-layout>

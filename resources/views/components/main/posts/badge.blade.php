{{-- resources/views/components/main/posts/badge.blade.php --}}
@php use Illuminate\Support\Str; @endphp
@props(['textColor', 'bgColor'])

<a {{ $attributes }} class="text-white bg-{{ Str::after($bgColor, '#')}} rounded-xl px-3 py-1 text-base">{{ $slot }} </a>

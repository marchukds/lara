@php use Carbon\Carbon; @endphp
@props(['value'])

<div>
    {{ Carbon::make($value)->diffForHumans() }}
</div>

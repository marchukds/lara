@extends('layouts.old')

@section('title', 'Abount Page Title')


@section('navbar')
    @parent
    <p> This is appended to master navbar</p>
@endsection

@section('content')
    <h1>{{ $title  }}</h1>
@endsection


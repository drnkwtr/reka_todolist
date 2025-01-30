@extends('layouts.app')

@section('head')
    @livewireStyles
@endsection

@section('bottom')
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>
@endsection

@section('content')
    @livewire('todo-list')
@endsection

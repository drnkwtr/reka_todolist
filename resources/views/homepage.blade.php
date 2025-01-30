@extends('layouts.app')

@section('content')
    <h1>test home page</h1>
    @auth()
        {{ auth()->user()->email  }}
    @endauth
@endsection

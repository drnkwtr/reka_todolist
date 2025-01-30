@extends('layouts.app')

@section('content')
    <div class="w-50 m-auto pt-5">
        <form action="{{ route('auth.register') }}" method="POST">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h1 class="mt-3 text-center">If still you have no account - join us</h1>
            <div class="form-group mt-3">
                <label for="exampleInputName1">Name</label>
                <input type="text" class="form-control" id="exampleInputName1" name="name" placeholder="Enter your name"
                       value="{{ old('name') }}">
            </div>
            <div class="form-group mt-3">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                       aria-describedby="emailHelp" placeholder="Enter email" value="{{ old('email') }}">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group mt-3">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                       placeholder="Password">
            </div>
            <div class="form-group mt-3">
                <label for="exampleInputPasswordConfirmation1">Confirm Password</label>
                <input type="password" class="form-control" id="exampleInputPasswordConfirmation1"
                       name="password_confirmation" placeholder="Confirm your password">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Register</button>
        </form>
    </div>
@endsection

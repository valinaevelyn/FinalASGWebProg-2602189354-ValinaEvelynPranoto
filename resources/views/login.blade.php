@extends('layouts.main_logreg')

@section('title', 'Login')
@section('content')
    <div class="container mt-5 d-flex justify-content-center align-items-center">
        <div class="col-md-6 mt-5">
            <h1 class="text-center mb-5">Login Form</h1>
            <div class="col shadow rounded p-3 mt-2">
                @include('partials.error')
                    <form action="{{ route('authenticate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com">

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" placeholder="Password">

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                    </form>

                <div class="d-flex justify-content-center">
                    <a href="{{ route('register') }}" class="text-center text-decoration-none">Don't have account? Register Here</a>
                </div>
            </div>
        </div>
    </div>
@endsection
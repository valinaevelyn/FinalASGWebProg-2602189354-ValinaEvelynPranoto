@extends('layouts.main')
@section('title', 'Avatar')

@section('content')
    <div class="container">
        <div class="col">
            <h1>Choose Friends</h1>
            @include('partials.error')
            <div class="col mt-4">
                <form action="{{ route('sendgift') }}" method="POST">
                    @csrf
                    <input type="hidden" name="avatar_id" value="{{ $avatar->id }}">
                    <div class="mb-3">
                        <select class="form-select @error('name') is-invalid @enderror" name="name" id="name" aria-label="Default select example">
                            <option value="" selected>--Choose User--</option>
                            @foreach($user as $u)
                                <option value="{{ $u->id }}" {{ old('name') == $u->id ? 'selected':'' }}>{{ $u->name }}</option>
                            @endforeach
                        </select>

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
    
                    <button type="submit" class="btn btn-primary">Send As Gift</button>
                </form>
            </div>
        </div>
    </div>
@endsection


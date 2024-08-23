@extends('layouts.main_logreg')

@section('title', 'Register')
@section('content')
    <div class="container mt-5 d-flex justify-content-center align-items-center mb-5">
        <div class="col-md-6 mt-5">
            <h1 class="text-center mb-5">Register Form</h1>
            <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="col shadow rounded p-3 mt-2">
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
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Name">

                        @error('name')
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

                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select @error('gender') is-invalid @enderror" name="gender" id="gender" aria-label="Default select example">
                            <option value="" selected>--Choose Gender--</option>
                            <option value="male" {{ old('gender') == "male" ? 'selected':'' }}>Male</option>
                            <option value="female" {{ old('gender') == "female" ? 'selected':'' }}>Female</option>
                        </select>

                        @error('gender')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Profile Photo</label>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">

                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="hobby[]" class="form-label">Hobbies</label>
                        
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hobby[]" value="sports" id="sports" {{ in_array('sports', old('hobby', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="sports">
                                Sports
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hobby[]" value="arts" id="arts" {{ in_array('arts', old('hobby', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="arts">
                                Arts
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hobby[]" value="outdoor" id="outdoor" {{ in_array('outdoor', old('hobby', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="outdoor">
                                Outdoor Activities
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hobby[]" value="music" id="music" {{ in_array('music', old('hobby', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="music">
                                Music
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hobby[]" value="literature" id="literature" {{ in_array('literature', old('hobby', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="literature">
                                Literature
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hobby[]" value="cooking" id="cooking" {{ in_array('cooking', old('hobby', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="cooking">
                                Cooking
                                </label>
                            </div>
                            @error('hobby')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="instagram" class="form-label">Instagram Username</label>
                        <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram" name="instagram" value="{{ old('instagram') }}" placeholder="http://instagram.com/...">

                        @error('instagram')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone_num" class="form-label">Phone Number</label>
                        <input type="number" class="form-control @error('phone_num') is-invalid @enderror" id="phone_num" name="phone_num" value="{{ old('phone_num') }}" placeholder="0xxxxxxxxxxxx">

                        @error('phone_num')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                
                    <button type="submit" class="btn btn-primary">Register</button>
            </form>

            <div class="d-flex justify-content-center">
                <a href="{{ route('login') }}" class="text-center text-decoration-none">Already have account? Login Here</a>
            </div>

            </div>
        </div>
    </div>
@endsection
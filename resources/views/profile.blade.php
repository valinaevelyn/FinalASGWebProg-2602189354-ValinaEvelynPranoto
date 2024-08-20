@extends('layouts.main')

@section('title', 'Profile')
@section('content')
<div class="container">
    <div class="col">
        <h1 class="text-center">My Profile</h1>

        <div class="row mt-5 mb-5">
            <div class="col d-flex justify-content-center align-items-center">
                <img src="{{ asset('/storage/profile_image/' . $user->image) }}" class="rounded-circle" style="width: 300px; height:300px; object-fit:cover" alt="...">
            </div>
            <div class="col d-flex align-items-center">
                <div class="col">
                    <h2>{{ $user->name }}</h2>
                    <div class="mt-3">
                        <p>Hobby: {{ $user->hobby }}</p>
                        <p>Gender: {{ $user->gender }}</p>
                        <p>Phone Number: {{ $user->phone_number }}</p>
                        <p>Instagram: {{ $user->instagram }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col mt-3">
            <h2>Wallet</h2>
            <p class="fs-5 text-center">My Wallet: {{ $user->coin }}</p>
            <div class="d-flex justify-content-center">
                <form action="{{ route('topup') }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-primary" style="width: 10rem">Top Up</button>
                </form>
            </div>
        </div>

        <div class="col mb-5 mt-5">
            <h1 class="text-center">Friend List</h1>
            <div class="col">
                <div class="row d-flex justify-content-center align-items-center">
                    @forelse($new_friend as $nf)
                    <div class="card m-3" style="width: 20rem;">
                        <img src="{{ asset('/storage/profile_image/' . $nf->image) }}" class="card-img-top" alt="..." style="object-fit: contain">
                        <div class="card-body">
                          <h5 class="card-title">{{ $nf->name }}</h5>
                          <p class="card-text">Hobbies: {{ $nf->hobby }}</p>
                          <a href="https://binus.zoom.us/j/4974777108?omn=92953642376" class="btn btn-primary"><i class="fa-solid fa-video"></i></i></i></a>
                        </div>
                      </div>  
                    @empty 
                        <p>No Data.</p>  
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
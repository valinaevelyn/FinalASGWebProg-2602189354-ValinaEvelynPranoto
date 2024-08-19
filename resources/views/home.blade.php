@extends('layouts.main')
@section('title', 'Home')

@section('content')
    <div class="container mt-4 d-flex justify-content-center">
        <div class="col">
            <h2>Search Your Friends</h2>
            <div class="col">
                @include('partials.success')
                @include('partials.error')
                <div class="row d-flex align-items-center">
                    @forelse($user as $u)
                    <div class="card m-3" style="width: 18rem;">
                        <img src="{{ asset('/storage/profile_image/' . $u->image) }}" class="card-img-top" alt="..." style="object-fit: contain">
                        <div class="card-body">
                          <h5 class="card-title">{{ $u->name }}</h5>
                          <p class="card-text">Hobbies: {{ $u->hobby }}</p>
                            
                          <form action="{{ route('friend.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                              <input type="hidden" id="receiver_id" name="receiver_id" value="{{ $u->id }}">
                              <button type="submit" class="btn btn-primary"><i class="fa-solid fa-thumbs-up"></i></a>
                          </form>
                        </div>
                      </div>  
                    @empty 
                        <p>No Data.</p>  
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
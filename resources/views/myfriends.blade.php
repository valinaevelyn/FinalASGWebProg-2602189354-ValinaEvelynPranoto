@extends('layouts.main')
@section('title', 'Home')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    <div class="col">
        @include('partials.success')
        <div class="col">
            <h2>Requested</h2>
            <div class="col">
                <div class="row">
                    @forelse($friend_requested as $fr)
                    <div class="card m-3" style="width: 18rem;">
                        <img src="{{ asset('/storage/profile_image/' . $fr->image) }}" class="card-img-top" alt="..." style="object-fit: contain">
                        <div class="card-body">
                          <h5 class="card-title">{{ $fr->name }}</h5>
                          <p class="card-text">Hobbies: {{ $fr->hobby }}</p>
                            
                          <form onclick="return confirm('are you sure?')" action="{{ route('friend.destroy', $fr->id) }}" method="POST" enctype="multipart/form-data">
                            @method('DELETE')
                            @csrf
                              <button type="submit" class="btn btn-primary">Cancel Request</i></a>
                          </form>
                        </div>
                      </div>  
                    @empty 
                        <p>No Data.</p>  
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col">
            <h2>Accept</h2>
            <div class="col">
                <div class="row">
                    @forelse($friend_accepted as $fa)
                    <div class="card m-3" style="width: 18rem;">
                        <img src="{{ asset('/storage/profile_image/' . $fa->image) }}" class="card-img-top" alt="..." style="object-fit: contain">
                        <div class="card-body">
                          <h5 class="card-title">{{ $fa->name }}</h5>
                          <p class="card-text">Hobbies: {{ $fa->hobby }}</p>
                            
                          <form action="{{ route('friend.update', $fa->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
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

        <div class="col">
            <h2>Friend List</h2>
            <div class="col">
                <div class="row">
                    @forelse($new_friend as $nf)
                    <div class="card m-3" style="width: 18rem;">
                        <img src="{{ asset('/storage/profile_image/' . $nf->image) }}" class="card-img-top" alt="..." style="object-fit: contain">
                        <div class="card-body">
                          <h5 class="card-title">{{ $nf->name }}</h5>
                          <p class="card-text">Hobbies: {{ $nf->hobby }}</p>
                          <button type="submit" class="btn btn-primary"><i class="fa-solid fa-comments"></i></i></a>
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
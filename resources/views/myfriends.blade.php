@extends('layouts.main')
@section('title', 'Manage Friends')
@section('activeManageFriends', 'Manage Friends')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    <div class="col">
        @include('partials.success')
        <div class="col mb-3">
            <h2>@lang('myfriends.sending_title')</h2>
            <div class="col">
                <div class="row">
                    @forelse($friend_requested as $fr)
                    <div class="card m-3" style="width: 18rem;">
                      @if($fr->is_avatar == true)
                          <img src="{{ asset($fr->image) }}" class="" style="" alt="...">
                      @else
                          <img src="{{ asset('/storage/profile_image/' . $fr->image) }}" class="" style="" alt="...">
                      @endif
                        <div class="card-body">
                          <h5 class="card-title">{{ $fr->name }}</h5>
                          <p class="card-text">Hobbies: {{ $fr->hobby }}</p>
                            
                          <form onclick="return confirm('are you sure?')" action="{{ route('friend.destroy', $fr->id) }}" method="POST" enctype="multipart/form-data">
                            @method('DELETE')
                            @csrf
                              <button type="submit" class="btn btn-primary">@lang('myfriends.cancel_request')</i></a>
                          </form>
                        </div>
                      </div>  
                    @empty 
                        <p>@lang('myfriends.no_data')</p>  
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col mb-3">
            <h2>@lang('myfriends.accepting_title')</h2>
            <div class="col">
                <div class="row">
                    @forelse($friend_accepted as $fa)
                    <div class="card m-3" style="width: 18rem;">
                      @if($fa->is_avatar == true)
                      <img src="{{ asset($fa->image) }}" class="" style="" alt="...">
                      @else
                      <img src="{{ asset('/storage/profile_image/' . $fa->image) }}" class="rounded-circle" style="width: 300px; height:300px; object-fit:cover" alt="...">
                      @endif
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
                        <p>@lang('myfriends.no_data')</p>  
                    @endforelse
                </div>
            </div>
        </div>
    
    </div>
</div>
@endsection
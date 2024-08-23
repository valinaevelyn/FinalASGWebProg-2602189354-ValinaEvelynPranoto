@extends('layouts.main')
@section('title', 'Manage Friends')
@section('activeManageFriends', 'Manage Friends')

@section('content')
<div class="container mt-4">
    <div class="row d-flex justify-content-evenly">
        @include('partials.success')
        <div class="col-md-6 mb-3 mt-5">
            <h3 class="text-center mb-4">@lang('myfriends.sending_title')</h3>
            <div class="col-md-10">
                <div class="row">
                    @forelse($friend_requested as $fr)
                      <div class="card m-3" style="padding-right: 0 !important; padding-left: 0 !important">
                        <div class="row g-0 h-100" style="">
                          <div class="col-md-4">
                            @if($fr->is_avatar == true)
                              <img src="{{ asset($fr->image) }}" class="img-fluid rounded-start" style="width: 100%; height: 100%; object-fit: cover;" alt="...">
                            @else
                              <img src="{{ asset('/storage/profile_image/' . $fr->image) }}" class="img-fluid rounded-start" style="width: 100%; height: 100%; object-fit: cover;" alt="...">
                            @endif
                          </div>
                          <div class="col-md-8">
                            <div class="card-body">
                              <h5 class="card-title">{{ $fr->name }}</h5>
                              <p class="card-text">Hobbies: {{ $fr->hobby }}</p>
                              <form onclick="return confirm('are you sure?')" action="{{ route('friend.destroy', $fr->id) }}" method="POST" enctype="multipart/form-data">
                                @method('DELETE')
                                @csrf
                                  <button type="submit" class="btn btn-warning">@lang('myfriends.cancel_request')</i></a>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      
                    @empty 
                        <p>@lang('myfriends.no_data')</p>  
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3 mt-5">
            <h3 class="text-center mb-4">@lang('myfriends.accepting_title')</h3>
            <div class="col-md-11">
                <div class="row">
                    @forelse($friend_accepted as $fa)
                    <div class="card m-3" style="padding-right: 0 !important; padding-left: 0 !important">
                      <div class="row g-0 h-100">
                        <div class="col-md-4">
                          @if($fa->is_avatar == true)
                            <img src="{{ asset($fa->image) }}" class="img-fluid rounded-start" style="width: 100%; height: 100%; object-fit: cover;" alt="...">
                          @else
                            <img src="{{ asset('/storage/profile_image/' . $fa->image) }}" class="img-fluid rounded-start" style="width: 100%; height: 100%; object-fit: cover;" alt="...">
                          @endif
                        </div>
                        <div class="col-md-8">
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
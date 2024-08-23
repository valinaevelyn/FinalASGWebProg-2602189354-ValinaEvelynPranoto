@extends('layouts.main')

@section('title', 'Profile')
@section('activeProfile', 'active')
@section('content')

<style>
    .custom-rounded {
        border-radius: 30px;
    }
</style>

<div class="container">
    <div class="col">
        <br>
        @include('partials.success')
        @include('partials.error')
        <br>
        <h1 class="text-center">@lang('profile.profile_title')</h1>
        <div class="row mt-5 mb-5">
            <div class="col d-flex justify-content-center align-items-center">
                @if($user->is_visible)
                    @if($user->is_avatar == true)
                        <img src="{{ asset($user->image) }}" class="rounded-circle" style="width: 300px; height:300px; object-fit:cover" alt="...">
                    @else
                        <img src="{{ asset('/storage/profile_image/' . $user->image) }}" class="rounded-circle" style="width: 300px; height:300px; object-fit:cover" alt="...">
                    @endif
                @else
                <img src="{{ asset('bear/' . mt_rand(1, 3) . '.jpg') }}" class="rounded-circle" style="width: 300px; height:300px; object-fit:cover" alt="...">
                @endif
            </div>
            <div class="col d-flex align-items-center mt-3 shadow custom-rounded p-4">
                <div class="col">
                    <h3 class="ms-3">{{ $user->name }}</h3>
                    <div class="mt-3">

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>@lang('profile.profile_header.hobby')</b> {{ $user->hobby }}</li>
                            <li class="list-group-item"><b>@lang('profile.profile_header.gender')</b> {{ $user->gender }}</li>
                            <li class="list-group-item"><b>@lang('profile.profile_header.phone_number')</b> {{ $user->phone_number }}</li>
                            <li class="list-group-item"><b>@lang('profile.profile_header.instagram')</b> {{ $user->instagram }}</li>
                          </ul>
                    </div>
                    
                    <div class="d-flex justify-content-center mt-4">
                        <div class="row">
                            <div class="col-md-7">
                                <form action="{{ route('visibility') }}" method="POST">
                                    @csrf
                                    @if($user->is_visible)
                                        <p>@lang('profile.your_visibility') : <b>@lang('profile.visibility_visible')</b></p>
                                        <input type="hidden" name="is_visible" value="1">
                                        <button type="submit" class="btn btn-warning">@lang('profile.hide_my_profile')</button>
                                    @else
                                        <p>@lang('profile.your_visibility') : <b>@lang('profile.visibility_hidden')</b></p>
                                        <input type="hidden" name="is_visible" value="0">
                                        <button type="submit" class="btn btn-warning">@lang('profile.show_my_profile')</button>
                                    @endif
                                </form>
                            </div>

                            <div class="col-md-5">
                                <div class="col">
                                    {{-- <h2>@lang('profile.wallet_title')</h2> --}}
                                    <p class=" text-center">@lang('profile.mywallet'): <b>{{ $user->coin }}</b></p>
                                    <div class="d-flex justify-content-center">
                                        <form action="{{ route('topup') }}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <button type="submit" class="btn btn-warning" style="width: 10rem">@lang('profile.topup')</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="col mb-5 mt-5">
            <h1 class="text-center">@lang('profile.friend_list')</h1>
            <div class="col">
                <div class="row d-flex justify-content-center align-items-center">
                    @forelse($new_friend as $nf)
                    <div class="card m-3" style="width: 20rem; height: 400px; overflow: hidden; padding-right: 0 !important; padding-left: 0 !important">
                        @if($nf->is_avatar == true)
                          <img src="{{ asset($nf->image) }}" class="" style="width: 100%; height: 200px; object-fit: contain; object-position: cover" alt="...">
                        @else
                          <img src="{{ asset('/storage/profile_image/' . $nf->image) }}" class="" style="width: 100%; height: 200px; object-fit: cover; object-position: center" alt="...">
                        @endif

                        
                            <div class="card-body">
                                <h5 class="card-title">{{ $nf->name }}</h5>
                                <p class="card-text">@lang('profile.profile_header.hobby') {{ $nf->hobby }}</p>
                                <div class="row">
                                    <div class="col-md-1 me-4">
                                        <a href="https://binus.zoom.us/j/4974777108?omn=92953642376" class="btn btn-warning"><i class="fa-solid fa-video"></i></i></i></a>
                                    </div>
    
                                    <div class="col-md-9">
                                        <form onclick="return confirm('are you sure?')" action="{{ route('friend.destroy', $nf->id) }}" method="POST" enctype="multipart/form-data">
                                            @method('DELETE')
                                            @csrf
                                              <button type="submit" class="btn btn-warning">@lang('profile.remove_friend')</i></a>
                                          </form>
                                      </div>
                                </div>
                            </div>
      
                              
                        
                        
                      </div>  
                    @empty 
                        <p>@lang('profile.no_data')</p>  
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
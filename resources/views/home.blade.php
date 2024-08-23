@extends('layouts.main')
@section('title', 'Home')
@section('activeHome', 'active')

@section('content')
    <div class="container mt-4 d-flex justify-content-center mb-5">
        <div class="col">
            <h2 class="text-center mb-5 mt-3">@lang('home.search_title')</h2>

            @include('partials.success')
                @include('partials.error')
                @include('partials.notification')

            <div class="col mt-3">
                <div class="row">
                    <div class="col-md-2" style="">
                        <div class="dropdown m-0">
                            <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 100%">
                              @lang('home.filter')
                            </button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="{{ route('home') }}">All</a></li>
                              <li><a class="dropdown-item" href="{{ route('filter_gender', "male") }}">@lang('home.male')</a></li>
                              <li><a class="dropdown-item" href="{{ route('filter_gender', "female") }}">@lang('home.female')</a></li>
                            </ul>
                          </div>
                    </div>
                      
                    <div class="col-md-10">
                        <form class="d-flex" role="search" action="{{ route('search') }}" method="POST">
                          @csrf
                            <input class="form-control me-1" type="search" placeholder="Search" aria-label="Search" style="width: 100%" id="input_search" name="input_search">
                            <button class="btn btn-outline-success" type="submit">@lang('home.search_button')</button>
                          </form>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="row d-flex justify-content-md-center align-items-center">
                    @forelse($user as $u)
                    <div class="card m-2 mt-5" style="width: 20rem;">
                      @if($u->is_avatar == true)
                          <img src="{{ asset($u->image) }}" class="" style="" alt="...">
                      @else
                          <img src="{{ asset('/storage/profile_image/' . $u->image) }}" class="" style="" alt="...">
                      @endif
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
                        <div class="mt-3">
                          <p>No Data.</p>
                        </div>  
                    @endforelse
                </div>
            </div>
            
        </div>

    </div>
    
@endsection
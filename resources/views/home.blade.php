@extends('layouts.main')
@section('title', 'Home')
@section('activeHome', 'active')

@section('content')

<style>
  .filter{
    background-color: rgb(255, 230, 156);
    /* border:0 */
  }
  
</style>

    <div class="container mt-4 d-flex justify-content-center mb-5">
        <div class="col">
        
            <h2 class="text-center mb-5 mt-3">@lang('home.search_title')</h2>
          
            @include('partials.success')
                @include('partials.error')
                @include('partials.notification')

            <div class="col mt-3">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-md-2" style="">
                        <div class="dropdown m-0">
                            <button class="btn btn-warning dropdown-toggle filter" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 100%">
                              @lang('home.filter')
                            </button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="{{ route('home') }}">All</a></li>
                              <li><a class="dropdown-item" href="{{ route('filter_gender', "male") }}">@lang('home.male')</a></li>
                              <li><a class="dropdown-item" href="{{ route('filter_gender', "female") }}">@lang('home.female')</a></li>
                            </ul>
                          </div>
                    </div>
                      
                    <div class="col-md-7">
                        <form class="d-flex" role="search" action="{{ route('search') }}" method="POST">
                          @csrf
                            <input class="form-control me-1" type="search" placeholder="Search" aria-label="Search" style="width: 850%" id="input_search" name="input_search">
                            <button class="btn btn-warning" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                          </form>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="row d-flex justify-content-md-center align-items-center">
                    @forelse($user as $u)
                    <div class="card m-2 mt-5" style="width: 20rem; height: 400px; overflow: hidden;">
                      @if($u->is_avatar == true)
                          <img src="{{ asset($u->image) }}" class="" style="width: 100%; height: 200px; object-fit: contain; object-position: cover" alt="...">
                      @else
                          <img src="{{ asset('/storage/profile_image/' . $u->image) }}" class="" style="width: 100%; height: 200px; object-fit: cover; object-position: center" alt="...">
                      @endif
                        <div class="card-body">
                          <h5 class="card-title">{{ $u->name }}</h5>
                          <p class="card-text">Hobbies: {{ $u->hobby }}</p>
                            
                          <form action="{{ route('friend.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                              <input type="hidden" id="receiver_id" name="receiver_id" value="{{ $u->id }}">
                              <button type="submit" class="btn btn-warning"><i class="fa-solid fa-thumbs-up"></i></a>
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
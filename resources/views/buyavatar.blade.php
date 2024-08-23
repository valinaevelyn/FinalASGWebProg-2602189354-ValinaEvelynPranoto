@extends('layouts.main')
@section('title', 'Avatar')

@section('content')
    <div class="container mt-5 d-flex justify-content-center align-items-center ">
        <div class="col-md-9">
            @include('partials.error')
            @include('partials.success')
            <h1 class="text-center">@lang('buyavatar.buyavatar_title')</h1>
            <div class="col mt-5">
                <div class="row">
                    @forelse($avatar as $a)
                    <div class="card m-2" style="width: 18rem;">
                        <img src="{{ asset($a->image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">{{ $a->name }}</h5>
                          <p class="card-text"><b>@lang('buyavatar.price'):</b> {{ $a->price }}</p>

                          
                          <div class="col">
                            <div class="row">
                              <div class="col-md-3">
                                <form action="{{ route('transaction.store') }}" method="POST" enctype="multipart/form-data">
                                  @csrf
                                    <input type="hidden" id="avatar_id" name="avatar_id" value="{{ $a->id }}">
                                    <button type="submit" class="btn btn-primary">@lang('buyavatar.buy')</button>
                                </form>
                              </div>
    
                              <div class="col-md-7">
                                <form action="{{ route('sendavatar') }}" method="GET" enctype="multipart/form-data">
                                  @csrf
                                    <input type="hidden" id="avatar_id" name="avatar_id" value="{{ $a->id }}">
                                    <button type="submit" class="btn btn-primary">@lang('buyavatar.send_gift')</button>
                                </form>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                    @empty 
                    <p>@lang('buyavatar.no_data')</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
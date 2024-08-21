@extends('layouts.main')
@section('title', 'Avatar')

@section('content')
    <div class="container mt-5 d-flex justify-content-center align-items-center ">
        <div class="col-md-10">
            @include('partials.error')
            @include('partials.success')
            <h1 class="text-center">Buy Avatar</h1>
            <div class="col mt-5">
                <div class="row">
                    @forelse($avatar as $a)
                    <div class="card m-2" style="width: 18rem;">
                        <img src="{{ asset($a->image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">{{ $a->name }}</h5>
                          <p class="card-text"><b>Price:</b> {{ $a->price }}</p>

                          <form action="{{ route('transaction.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                              <input type="hidden" id="avatar_id" name="avatar_id" value="{{ $a->id }}">
                              <button type="submit" class="btn btn-primary">Buy</button>
                          </form>
                        </div>
                      </div>
                    @empty 
                    <p>No Data</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
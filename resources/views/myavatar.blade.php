@extends('layouts.main')
@section('title', 'Avatar')

@section('content')
    <div class="container mt-5 d-flex justify-content-center align-items-center ">
        <div class="col-md-10">
            @include('partials.error')
            @include('partials.success')
            <h1 class="text-center">My Avatar</h1>
            <div class="col mt-5">
                <div class="row">
                    @forelse($avatar as $a)
                    <div class="card m-2" style="width: 18rem;">
                        <img src="{{ asset($a->image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">{{ $a->name }}</h5>

                          <div class=" d-flex justify-content-end">
                            <form action="{{ route('useavatar', $a->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                  
                                  <button type="submit" class="btn btn-primary">Use</button>
                              </form>
                          </div>
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
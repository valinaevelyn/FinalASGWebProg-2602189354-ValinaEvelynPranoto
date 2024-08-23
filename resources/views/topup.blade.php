@extends('layouts.main')
@section('title', 'Avatar')
@section('activeTopup', 'active')

@section('content')
    <div class="container mt-4">
        <div class="col">
            <h1 class="text-center mt-5">@lang('topup.topup_title')</h1>
                <div class="col-md-12 mt-5 shadow p-5 ">
                    <p class=" text-center">@lang('topup.mywallet'): <b>{{ $user->coin }}</b></p>
                    <div class="d-flex justify-content-center">
                        <form action="{{ route('topup') }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <button type="submit" class="btn btn-warning" style="width: 10rem">@lang('topup.topup')</button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
@endsection
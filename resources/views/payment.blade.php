@extends('layouts.main_logreg')

@section('title', 'Payment')
@section('content')
<div class="container mt-5 d-flex justify-content-center align-items-center">
<div class="col-md-6 mt-5">
    <h2>Payment Register</h2>
    <p>To complete the register, please do payment</p>
    <p><b>Total Payment: </b>{{ $register_payment }}</p>
    <form action="{{ route('payment') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="payment" class="form-label">Payment</label>
            <input type="number" class="form-control @error('payment') is-invalid @enderror" id="payment" name="payment" value="{{ old('payment') }}" placeholder="Input Payment">

            @error('payment')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mb-3">Pay</button>

    </form>
    @if($message = Session::get('underpaid'))
       <p><b>{{ $message }}</b></p>
    @elseif($message = Session::get('overpaid'))
        <p><b>{{ $message }}</b></p>
        
        <form action="{{ route('overpaidyes') }}" method="POST">
            @method('PUT')
            @csrf
            <button type="submit" class="btn btn-warning btn-sm">Yes</button>
        </form>
        <a href="{{ route('pay') }}" class="btn btn-danger btn-sm">No</a>
    @endif
</div>

</div>
@endsection
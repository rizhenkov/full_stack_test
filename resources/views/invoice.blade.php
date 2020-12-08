@extends('layouts.app')
@section('content')

    <div class="bg-white shadow-sm">

        <form class="p-3" action="" method="post">
            <h2>Invoice</h2>

            <h4>{{ $invoice->school }}</h4>
            <p class="mb-0">{{ $invoice->description }}</p>
            <p class="mb-5">Amount: {{ $invoice->amount }}$</p>

            @if($invoice->status)
            <div>
                Status: <span class="text-success">Payment received</span>
            </div>
            @else
            @csrf
            <div class="form-row">
                <div class="col-lg-5">
                    <div class="form-group">
                        <label for="inputEmail">Full name</label>
                        <input type="text" class="form-control" id="inputEmail"
                               name="payer" placeholder="" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Pay</button>
            @endif
        </form>

        @if(session('status'))
            <div class="p-3">
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            </div>
        @endif
    </div>

@endsection

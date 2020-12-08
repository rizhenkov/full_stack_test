@extends('layouts.app')
@section('content')

    <div class="bg-white shadow-sm">

        <form class="p-3" action="/login" method="post">
            @csrf
            <div class="form-group">
                <label for="inputEmail">Email address</label>
                <input type="email" class="form-control" id="inputEmail"
                       name="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control" id="inputPassword"
                       name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        @if(isset($error))
            <div class="p-3">
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            </div>
        @endif
    </div>

@endsection

{{--@once
    @push('scripts')
        <script src="{{ mix('/js/app.js')  }}"></script>
    @endpush
@endonce--}}

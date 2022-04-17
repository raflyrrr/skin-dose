@extends('backend.home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    Hi. Anda telah login sebagai, {{Auth::user()->name}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
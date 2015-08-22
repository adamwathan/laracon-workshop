@extends('layout')

@section('body')
<div class="container">
    <div class="row">
        <div class="col-sm-7">
            @yield('content')
        </div>
        <div class="col-sm-5">
            @include('partials.who-to-follow')
        </div>
    </div>
</div>
@endsection
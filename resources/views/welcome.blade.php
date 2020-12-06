@extends('layouts.app')

@section('content')

    <div class="w-100 h-100 d-flex justify-content-center align-items-center">
        <div class="text-center w-50">
            <img src="/img/easychess.png" class="mw-100">
            <a style="background-color: #000;color: #fff;position: absolute;left: 50%;top: 50%;transform: translate(-50%);" class="p-5 text-uppercase font-weight-bold" href="{{url('/home')}}"><h2>Play</h2></a>
        </div>
    </div>

@endsection

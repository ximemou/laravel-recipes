@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                @if($profile->image)
                    <img src="/storage/{{$profile->image}}" class="w-100 rounded-circle">
                @endif
            </div>
            <div class="col-md-7 mt-5 mt-md-0">
                <h2 class="text-center mb-2 text-primary"> {{$profile->user->name}}</h2>
                <a href="{{$profile->user->url}}">Visitar sitio web </a>
                <div class="biography">
                    {!! $profile->biography !!}
                </div>
            </div>
        </div>
    </div>

@endsection

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

<h2 class="text-center my-5"> Recetas creadas por:  {{$profile->user->name}}</h2>
<div class="container">
    <div class="row mx-auto bg-white p-4">
        @if(count($recipes)> 0)
            @foreach($recipes as $recipe)
                <div class="col-md-4 mb-4">
                    <div class="card">
                    <img src="/storage/{{$recipe->image}}" class="card-img-top" alt="recipe image">
                    <div class="card-body">
                        <h3> {{$recipe->title}} </h3>
                    <a href="{{route('recipes.show',['recipe'=>$recipe->id])}}" class="btn btn-primary d-block mt-4 text-uppercase font-weight-bold" >Receta</a>
                    </div>

                    </div>
                </div>

            @endforeach
        @else
            <p class="text-center w-100"> No hay recetas ...</p>
        @endif
    </div>
    <div class="d-flex justify-content-center" >
        {{$recipes->links()}}
    </div>
</div>

@endsection

@extends('layouts.app');

@section('content')
    <article class="recipe-content">
        <h1 class="text-center mb-4">{{$recipe->title}}</h1>
        <div class="recipe-image">
            <img src="/storage/{{$recipe->image}}" class="w-100">
        </div>
        <div class="meta-recipe mt-2">
            <p>
                <span class="font-weight-bold text-primary">Escrito en:</span>
                {{$recipe->category->name}}
            </p>
            <p>
                <span class="font-weight-bold text-primary">Autor:</span>
                {{$recipe->author->name}}
            </p>
            <p>
                <span class="font-weight-bold text-primary">Fecha:</span>
                @php
                    $date = $recipe->created_at
                @endphp
                <recipe-date date="{{$date}}"></recipe-date>
            </p>

            <div class="ingredients">
                <h2 class="my-3 text-primary">Ingredientes</h2>
                {!! $recipe->ingredients !!}
            </div>
            <div class="preparation">
                <h2 class="my-3 text-primary">Preparación</h2>
                {!! $recipe->preparation !!}
            </div>
        </div>
    </article>

@endsection

@extends('layouts.app');

@section('content')
    <article class="recipe-content bg-white p-5 shadow">
        <h1 class="text-center mb-4">{{$recipe->title}}</h1>
        <div class="recipe-image">
            <img src="/storage/{{$recipe->image}}" class="w-100">
        </div>
        <div class="meta-recipe mt-3">
            <p>
                <span class="font-weight-bold text-primary">Escrito en:</span>
            <a class="text-dark" href="{{route('categories.show',['recipeCategory'=> $recipe->category->id ])}}">
                {{$recipe->category->name}}
            </a>
            </p>
            <p>
                <span class="font-weight-bold text-primary">Autor:</span>
                <a class="text-dark" href="{{route('profiles.show',['profile'=> $recipe->author->id])}}">
                    {{$recipe->author->name}}
                </a>
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

            <div class="justify-content-center row text-center">
                <like-button
                    recipe-id="{{$recipe->id}}"
                    like="{{$like}}"
                    likes="{{$likes}}"
                >
            </like-button>
            </div>
        </div>
    </article>

@endsection

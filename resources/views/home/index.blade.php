@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
@endsection

@section('hero')
    <div class="hero-categorias">
        <form class="container h100" action={{route('search.show')}}>
            <div class="row h-100 align-items-center">
                <div class="col-md-4 texto-buscar">
                    <p class="display-4"> Encuentra tu próxima receta</p>
                    <input
                        type="search"
                        name="search"
                        class="form-control"
                        placeholder="Buscar receta"
                    />
                </div>
            </div>
        </form>
    </div>
@endsection
@section('content')

    {{-- <img src="{{asset('/images/fondo.jpg')}}" alt="imagen fondo"> --}}
    <div class="container nuevas-recetas">
        <h2 class="titulo-categoria text-uppercase mb-4">Últimas recetas</h2>
        <div class="owl-carousel owl-theme">
            @foreach($newest as $new)
                <div class="card">
                    <img src="/storage/{{$new->image}}" class="card-img-top" alt="imagen receta">
                    <div class="card-body">
                        <h3>{{Str::title($new->title)}}</h3>
                        <p> {{Str::words(strip_tags($new->preparation), 20)}} </p>
                    <a href="{{route('recipes.show', ['recipe'=>$new->id])}}" class="btn btn-primary d-block font-weight-bold text-uppercase"> Ver receta</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4"> Recetas mas votadas</h2>
        <div class="row">
                @foreach($voted as $recipe)
                    @include('ui.recipe')
                @endforeach
        </div>
    </div>

    @foreach($recipes as $key => $group)
        <div class="container">
            <h2 class="titulo-categoria text-uppercase mt-5 mb-4"> {{ str_replace('-',' ',$key)}}</h2>
            <div class="row">
                @foreach($group as $recipes)
                    @foreach($recipes as $recipe)
                        @include('ui.recipe')
                    @endforeach
                @endforeach
            </div>
        </div>
    @endforeach
@endsection

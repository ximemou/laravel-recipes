@extends('layouts.app');

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css" integrity="sha512-qjOt5KmyILqcOoRJXb9TguLjMgTLZEgROMxPlf1KuScz0ZMovl0Vp8dnn9bD5dy3CcHW5im+z5gZCKgYek9MPA==" crossorigin="anonymous" />
@endsection

@section('buttons')
<a href="{{route('recipes.index')}}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
    <svg clas="buttonIcon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path></svg>
    Volver
</a>
@endsection

@section('content')
    <h2 class="text-center mb-5"> Crear receta </h2>
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
        <form method="POST" enctype="multipart/form-data" action="{{route('recipes.store')}}" novalidate>
            @csrf
                <div class="form-group">
                    <label for="title"> Titulo receta </label>
                    <input type="text"
                           name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           id="title"
                           placeholder="Titulo receta"
                           value={{old('title')}}
                    >
                    @error('title')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong> {{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category"> Categoria </label>
                    <select
                        name="category"
                        class="form-control @error('category') is-invalid @enderror"
                        id="category"

                    >
                        <option value="">Seleccione</option>
                        @foreach($categories as $category)
                            <option
                                value="{{$category->id}}"
                                {{old('category') == $category->id ? 'selected': ''}}>
                                {{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong> {{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="preparation"> Preparación </label>
                    <input
                        id="preparation"
                        type="hidden" name="preparation"
                        value="{{old('preparation')}}"
                    >
                    <trix-editor
                        class="@error('preparation') is-invalid @enderror"
                        input="preparation">
                    </trix-editor>

                    @error('preparation')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong> {{$message}}</strong>
                        </span>
                    @enderror

                </div>
                <div class="form-group mt-3">
                    <label for="ingredients"> Ingredientes </label>
                    <input
                        id="ingredients"
                        type="hidden" name="ingredients"
                        value="{{old('ingredients')}}"
                    >
                    <trix-editor
                        class="@error('ingredients') is-invalid @enderror"
                        input="ingredients">
                    </trix-editor>
                    @error('ingredients')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong> {{$message}}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group mt-3">
                    <label for="image"> Elige la imagen </label>
                    <input
                        id="image"
                        type="file"
                        class="form-control @error('ingredients') is-invalid @enderror"
                        name="image"
                    >
                    @error('image')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong> {{$message}}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Agregar receta"/>
                </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js" integrity="sha512-zEL66hBfEMpJUz7lHU3mGoOg12801oJbAfye4mqHxAbI0TTyTePOOb2GFBCsyrKI05UftK2yR5qqfSh+tDRr4Q==" crossorigin="anonymous" defer></script>
@endsection

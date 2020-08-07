@extends('layouts.app');

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css" integrity="sha512-qjOt5KmyILqcOoRJXb9TguLjMgTLZEgROMxPlf1KuScz0ZMovl0Vp8dnn9bD5dy3CcHW5im+z5gZCKgYek9MPA==" crossorigin="anonymous" />
@endsection

@section('buttons')
    <a href="{{route('recipes.index')}}" class="btn btn-primary mr-2 text-white"> Volver </a>
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

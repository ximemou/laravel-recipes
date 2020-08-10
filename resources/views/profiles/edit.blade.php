@extends('layouts.app')

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

    <h1 class="text-center"> Editar mi perfil</h1>
    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white p-3">
            <form
                action="{{route('profiles.update',['profile'=>$profile->id])}}"
                method="POST"
                enctype="multipart/form-data"
            >
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label for="title"> Nombre </label>
                    <input type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        id="name"
                        placeholder="Tu nombre"
                        value="{{$profile->user->name}}"

                    >
                    @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong> {{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="url"> Sitio web </label>
                    <input type="text"
                           name="url"
                           class="form-control @error('url') is-invalid @enderror"
                           id="url"
                           placeholder="Tu sitio web"
                           value="{{$profile->user->url}}"

                    >
                    @error('url')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong> {{$message}}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group mt-3">
                    <label for="biography"> Biografia </label>
                    <input
                        id="biography"
                        type="hidden"
                        name="biography"
                        value="{{$profile->biography}}"

                    >
                    <trix-editor
                        class="@error('biography') is-invalid @enderror"
                        input="biography">
                    </trix-editor>

                    @error('biography')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong> {{$message}}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group mt-3">
                    <label for="image"> Tu imagen </label>
                    <input
                        id="image"
                        type="file"
                        class="form-control @error('ingredients') is-invalid @enderror"
                        name="image"
                    >

                    @if($profile->image)
                        <div class="mt-4">
                            <p> Imagen Actual:</p>
                            <img src="/storage/{{$profile->image}}" style="width: 300px">
                        </div>

                        @error('image')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong> {{$message}}</strong>
                            </span>
                        @enderror
                    @endif
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Editar perfil"/>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js" integrity="sha512-zEL66hBfEMpJUz7lHU3mGoOg12801oJbAfye4mqHxAbI0TTyTePOOb2GFBCsyrKI05UftK2yR5qqfSh+tDRr4Q==" crossorigin="anonymous" defer></script>
@endsection

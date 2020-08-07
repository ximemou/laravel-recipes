@extends('layouts.app');

@section('buttons')
<a  href="{{route('recipes.create')}}" class="btn btn-primary mr-2 text-white"> Crear receta </a>
@endsection

@section('content')
    <h2 class="text-center mb-5"> Administra tus recetas </h2>
    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col"> Titulo</th>
                    <th scole="col"> Categoria</th>
                    <th scole="col"> Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recipes as $recipe)
                    <tr>
                        <td>{{$recipe->title}} </td>
                        <td>{{$recipe->category->name}} </td>
                        <td>
                            <delete-recipe recipe-id={{$recipe->id}}></delete-recipe>
                            <a href="{{route('recipes.edit',['recipe'=>$recipe->id])}}" class="btn btn-dark d-block mr-1">Editar</a>
                            <a href="{{route('recipes.show',['recipe'=>$recipe->id])}}" class="btn btn-success d-block mr-1">Ver</a>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection


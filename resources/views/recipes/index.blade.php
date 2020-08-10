@extends('layouts.app');

@section('buttons')
    @include('ui.navigation')
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

        <div class="col-12 mt-4 justify-content-center d-flex">
            {{$recipes->links()}}
        </div>

        <h2 class="text-center my-5"> Recetas que te gustan</h2>
        <div class="col-md-10 mx-auto bg-white p-3">
            @if(count($user->iLike)>0)
                <ul class="list-group">
                    @foreach($user->iLike as $recipe)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <p>{{$recipe->title}}</p>
                            <a class="btn btn-outline-success text-uppercase font-weight-bold" href="{{route('recipes.show',['recipe'=> $recipe->id])}}"> Ver</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-center"> No tienes recetas guardadas
                    <small> Dale me gusta a las recetas y apareceran aqui </small>
                </p>
            @endif
        </div>
    </div>
@endsection


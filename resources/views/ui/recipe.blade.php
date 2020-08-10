<div class="col-md-4 mt-4">
    <div class="card shadow">
        <img class="card-img-top" src="/storage/{{$recipe->image}}" alt="imagen receta">
        <div class="card-body">
            <h3 class="card-title"> {{$recipe->title}}</h3>
            <div class="meta-receta d-flex justify-content-between">
                @php
                    $date = $recipe->created_at
                @endphp
                <p class="text-primary fecha font-weight-bold">
                    <recipe-date date="{{$date}}"></recipe-date>
                </p>
                <p>{{count($recipe->likes)}} Les gusto </p>
            </div>
            <p> {{Str::words(strip_tags($recipe->preparation), 20, '...')}} </p>
            <a href="{{route('recipes.show',['recipe'=>$recipe->id])}}"
                class="btn btn-primary d-block btn-receta">
                Ver receta
            </a>
        </div>
    </div>
</div>

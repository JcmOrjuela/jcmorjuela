<div class="my-2">
    <div class="rounded border shadow p-4">

        <div class="row">
            <div class="col-md-8 mt-3">
                <label for=""> Buscar Película: </label>
                <input id="filterMovie" type="text" class="form-control">
            </div>
            <div class="col-md-3 mt-3">
                <label for="" class="text-white"> Buscar: </label><br>
                <input type="button" onclick="searchMovie()" value="Buscar" class="btn btn-primary">
            </div>
        </div>

    </div>
    <div id="cards-content" class="rounded border shadow p-4 mt-4 hide">
        <div id="cards-movie" class="row ml-5 pl-5">

        </div>
    </div>
</div>


<?php

$movies = json_encode($movies ?? []);
$service = requestUri();

$action = !preg_match('/movies/i', $service) ? 'Agregar' : 'Remover';

$script = <<<script
    <script>
        const URI = 'https://www.omdbapi.com/'
        const KEY = "apiKey=fc59da33"

        const MOVIES = {
            "searches": $movies,
            "userMovies": [],
            "action": '$action'
        };
    </script>
    <script src="views/js/home.js"></script>
script;
?>
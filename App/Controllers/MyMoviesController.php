<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\UserMovie;
use App\Request;

class MyMoviesController
{
    public function index()
    {
        $userMovies = new UserMovie();

        $movies = $userMovies->search(4, 'user_id');

        return view('home/index', ["movies" => $movies->getContent()], null);
    }
    public function store(Request $r)
    {
        try {
            $r->validate([
                'imdbID' => 'required',
                'Poster' => 'required',
                'Title' => 'required',
                'Type' => 'required',
                'Year' => 'required'
            ]);

            $r = $r->all();
            $userMovies = new UserMovie();

            $userMovies->create(
                [
                    'imdbID' => $r->imdbID,
                    'user_id' => 4,
                    'Poster' => $r->Poster,
                    'Title' => $r->Title,
                    'Type' => $r->Type,
                    'Year' => $r->Year,
                ]
            );
            return  response()->json([
                "httpCode" => 200,
                "message" => "Agregado Correctamente"
            ]);
        } catch (\Exception $e) {

            return response()->json([
                "httpCode" => 400,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $userMovies = new UserMovie();
            $movie = $userMovies->search($id, 'imdbID');
            $userMovies->delete(
                key($movie->getContent())
            );

            return  response()->json([
                "httpCode" => 200,
                "message" => "Removido Correctamente"
            ]);
        } catch (\Exception $e) {

            return response()->json([
                "httpCode" => 400,
                "message" => $e->getMessage()
            ]);
        }
    }
}

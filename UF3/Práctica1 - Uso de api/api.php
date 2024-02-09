<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;
use App\Models\Pokemon;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Para crear el pokemon
Route::post('/pokemons', [PokemonController::class, 'store']);

// Para mostrarlo
Route::get('/pokemons', [PokemonController::class, 'show']);

// Actualizar datos del pokemon
Route::put('/pokemons/{poke}    ', [PokemonController::class, 'update']);

// Destruir el pokemon
Route::delete('/pokemons/{poke}', [PokemonController::class, 'destroy']);


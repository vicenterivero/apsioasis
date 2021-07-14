<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::GET('/oasis/centro_consumo/restaurantes',[ApiController::class,'restaurantes']);
Route::GET('/oasis/centro_consumo/bares',[ApiController::class,'bares']);
Route::GET('/oasis/centro_consumo/horario',[ApiController::class,'horario']);
Route::GET('/oasis/centro_consumo/detalle',[ApiController::class,'detalle']);
Route::GET('/oasis/hoteles',[ApiController::class,'hoteles']);

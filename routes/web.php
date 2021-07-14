<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
/* Route::GET('/oasis/centro_consumo',[ApiController::class,'restaurantes']);
Route::GET('/oasis/centro_consumo/horario',[ApiController::class,'horario']);
Route::GET('/oasis/centro_consumo/detalle',[ApiController::class,'detalle']);
Route::GET('/oasis/hoteles',[ApiController::class,'hoteles']);
Route::GET('/oasis/hoteles/propiedad',[ApiController::class,'propiedad']); */

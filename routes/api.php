<?php

use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('sanctum')->post('/api/libros', function (Request $request) {
    $request->validate([
        'nombre' => 'required',
        'descripcion' => 'required',
        'idioma' => 'required',
        'precio' => 'required',
        'estado' => 'required',
    ]);
    $libro = new Libro;
    $libro->nombre = $request->nombre;
    $libro->descripcion = $request->descripcion;
    $libro->idioma = $request->idioma;
    $libro->precio = $request->precio;
    $libro->estado = $request->estado;
    $libro->fecha_ingreso = Carbon\Carbon::now();
    if(!empty(json_decode($request->ediciones_pasdas))){
        $libro->ediciones_pasdas = $request->ediciones_pasdas;
    }
    $libro->save();
});

Route::middleware('sanctum')->get('/api/libros', function (Request $request) {
    return Libro::all();
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RutinaController;
use App\Http\Controllers\EjercicioController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\SuscripcionController;
use App\Http\Controllers\RutinaEjercicioController;
use App\Http\Controllers\EjercicioPuntuacionController;
use App\Http\Controllers\RutinaPuntuacionController;

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

//Users
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/user/registro', [UserController::class, 'store']);
Route::post('/user/login', [UserController::class, 'login']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);

//Rutinas
Route::get('/rutina', [RutinaController::class, 'index']);
Route::get('/rutina/{id}', [RutinaController::class, 'show']);
Route::post('/rutina', [RutinaController::class, 'store']);
Route::put('/rutina/{id}', [RutinaController::class, 'update']);
Route::delete('/rutina/{id}', [RutinaController::class, 'destroy']);

//Ejercicios
Route::get('/ejercicio', [EjercicioController::class, 'index']);
Route::get('/ejercicio/{id}', [EjercicioController::class, 'show']);
Route::post('/ejercicio', [EjercicioController::class, 'store']);
Route::put('/ejercicio/{id}', [EjercicioController::class, 'update']);
Route::delete('/ejercicio/{id}', [EjercicioController::class, 'destroy']);

//Fotos
Route::get('/foto', [FotoController::class, 'index']);
Route::get('/foto/{id}', [FotoController::class, 'show']);
Route::post('/foto', [FotoController::class, 'store']);
Route::put('/foto/{id}', [FotoController::class, 'update']);
Route::delete('/foto/{id}', [FotoController::class, 'destroy']);
Route::post('/foto/subirFotos/{id}', [FotoController::class,'subirFoto']);

//Suscripcion
Route::get('/suscripcion', [SuscripcionController::class, 'index']);
Route::get('/suscripcion/{id}', [SuscripcionController::class, 'show']);
Route::post('/suscripcion', [SuscripcionController::class, 'store']);
Route::put('/suscripcion/{id}', [SuscripcionController::class, 'update']);
Route::delete('/suscripcion/{id}', [SuscripcionController::class, 'destroy']);

//Notificación
Route::get('/notificacion', [NotificacionController::class, 'index']);
Route::get('/notificacion/{id}', [NotificacionController::class, 'show']);
Route::post('/notificacion', [NotificacionController::class, 'store']);
Route::put('/notificacion/{id}', [NotificacionController::class, 'update']);
Route::delete('/notificacion/{id}', [NotificacionController::class, 'destroy']);

//RutinaHasEjercicios
Route::get('/rutinaejercicio', [RutinaEjercicioController::class, 'index']);
Route::get('/rutinaejercicio/{id}', [RutinaEjercicioController::class, 'show']);
Route::post('/rutinaejercicio', [RutinaEjercicioController::class, 'store']);
Route::put('/rutinaejercicio/{id}', [RutinaEjercicioController::class, 'update']);
Route::delete('/rutinaejercicio/{id}', [RutinaEjercicioController::class, 'destroy']);

//RutinaHasPuntuacion
Route::get('/rutinapuntuacion', [RutinaPuntuacionController::class, 'index']);
Route::get('/rutinapuntuacion/{id}', [RutinaPuntuacionController::class, 'show']);
Route::post('/rutinapuntuacion', [RutinaPuntuacionController::class, 'store']);
Route::put('/rutinapuntuacion/{id}', [RutinaPuntuacionController::class, 'update']);
Route::delete('/rutinapuntuacion/{id}', [RutinaPuntuacionController::class, 'destroy']);

//EjercicioPuntuacion
Route::get('/ejerciciopuntuacion', [EjercicioPuntuacionController::class, 'index']);
Route::get('/ejerciciopuntuacion/{id}', [EjercicioPuntuacionController::class, 'show']);
Route::post('/ejerciciopuntuacion', [EjercicioPuntuacionController::class, 'store']);
Route::put('/ejerciciopuntuacion/{id}', [EjercicioPuntuacionController::class, 'update']);
Route::delete('/ejerciciopuntuacion/{id}', [EjercicioPuntuacionController::class, 'destroy']);


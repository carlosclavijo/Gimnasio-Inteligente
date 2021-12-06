<?php

namespace App\Http\Controllers;

use App\Models\Ejerciciopuntuacion;
use Illuminate\Http\Request;

class EjercicioPuntuacionController extends Controller
{
    public function index()
    {
        try {
            $ListEjercicioHasPuntuacions = Ejerciciopuntuacion::all();
        }
        catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Length' => count($ListEjercicioHasPuntuacions), 'EjercicioHasPuntuacions' => $ListEjercicioHasPuntuacions]);
    }

    public function show($idEjercicioHasPuntuacion)
    {
        try {
            $objEjercicioHasPuntuacion = Ejerciciopuntuacion::find($idEjercicioHasPuntuacion);
            if($objEjercicioHasPuntuacion == null) {
                return response()->json(['Response' => false, 'Message' => 'Error, Ejerciciopuntuacion no encontrado']);
            }
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Ejerciciopuntuacion' => $objEjercicioHasPuntuacion]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->json()->all(), [
            'puntuacion' => ['required', 'integer', 'min:1', 'max:5'],
            'idUsuario' => ['required', 'integer'],
            'idEjercicio' => ['required', 'integer']
        ]);
        if($validator->fails()) {
            return response()->json(["Response" => false, "validator" => $validator->messages()]);
        }
        $objEjercicioHasPuntuacion = new Ejerciciopuntuacion();
        $objEjercicioHasPuntuacion->puntuacion = $request->json("puntuacion");
        $objEjercicioHasPuntuacion->idUsuario = $request->json("idUsuario");
        $objEjercicioHasPuntuacion->idEjercicio = $request->json("idEjercicio");
        try {
            $objEjercicioHasPuntuacion->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => $e]);
        }
        return response()->json(['Response' => true,  'id' => $objEjercicioHasPuntuacion->id, 'Ejerciciopuntuacion' => $objEjercicioHasPuntuacion]);
    }

    public function update(Request $request, $idEjercicioHasPuntuacion)
    {
        $objEjercicioHasPuntuacion = Ejerciciopuntuacion::find($idEjercicioHasPuntuacion);
        if($objEjercicioHasPuntuacion == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, Ejerciciopuntuacion no encontrado']);
        }
        if($request->json('idUsuario') != null) {
            $objEjercicioHasPuntuacion->idUsuario = $request->json('idUsuario');
        }
        if($request->json('idEjercicio') != null) {
            $objEjercicioHasPuntuacion->idEjercicio = $request->json('idEjercicio');
        }
        if($request->json('puntuacion') != null) {
            $objEjercicioHasPuntuacion->puntuacion = $request->json('puntuacion');
        }
        try {
            $objEjercicioHasPuntuacion->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Ha sucedido un error']);
        }
        return response()->json(['Response' => true, 'ejercicioHasPuntuacions' => $objEjercicioHasPuntuacion]);
    }

    public function destroy($idEjercicioHasPuntuacion)
    {
        $objEjercicioHasPuntuacion = Ejerciciopuntuacion::find($idEjercicioHasPuntuacion);
        if($objEjercicioHasPuntuacion == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, Ejerciciopuntuacion no encontrado']);
        }
        try {
            $objEjercicioHasPuntuacion->delete();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true]);
    }
}

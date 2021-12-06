<?php

namespace App\Http\Controllers;

use App\Models\Rutinapuntuacion;
use Illuminate\Http\Request;

class RutinaPuntuacionController extends Controller
{
    public function index()
    {
        try {
            $ListRutinaHasPuntuacions = Rutinapuntuacion::all();
        }
        catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Length' => count($ListRutinaHasPuntuacions), 'RutinaHasPuntuacions' => $ListRutinaHasPuntuacions]);
    }

    public function show($idRutinaHasPuntuacion)
    {
        try {
            $objRutinaHasPuntuacion = Rutinapuntuacion::find($idRutinaHasPuntuacion);
            if($objRutinaHasPuntuacion == null) {
                return response()->json(['Response' => false, 'Message' => 'Error, Rutinapuntuacion no encontrado']);
            }
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Rutinapuntuacion' => $objRutinaHasPuntuacion]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->json()->all(), [
            'puntuacion' => ['required', 'integer', 'min:1', 'max:5'],
            'idUsuario' => ['required', 'integer'],
            'idRutina' => ['required', 'integer']
        ]);
        if($validator->fails()) {
            return response()->json(["Response" => false, "validator" => $validator->messages()]);
        }
        $objRutinaHasPuntuacion = new Rutinapuntuacion();
        $objRutinaHasPuntuacion->puntuacion = $request->json("puntuacion");
        $objRutinaHasPuntuacion->idUsuario = $request->json("idUsuario");
        $objRutinaHasPuntuacion->idRutina = $request->json("idRutina");
        try {
            $objRutinaHasPuntuacion->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => $e]);
        }
        return response()->json(['Response' => true,  'id' => $objRutinaHasPuntuacion->id, 'Rutinapuntuacion' => $objRutinaHasPuntuacion]);
    }

    public function update(Request $request, $idRutinaHasPuntuacion)
    {
        $objRutinaHasPuntuacion = Rutinapuntuacion::find($idRutinaHasPuntuacion);
        if($objRutinaHasPuntuacion == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, Rutinapuntuacion no encontrado']);
        }
        if($request->json('idRutina') != null) {
            $objRutinaHasPuntuacion->idRutina = $request->json('idRutina');
        }
        if($request->json('idEjercicio') != null) {
            $objRutinaHasPuntuacion->idEjercicio = $request->json('idEjercicio');
        }
        try {
            $objRutinaHasPuntuacion->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Ha sucedido un error']);
        }
        return response()->json(['Response' => true, 'RutinaHasPuntuacions' => $objRutinaHasPuntuacion]);
    }

    public function destroy($idRutinaHasPuntuacion)
    {
        $objRutinaHasPuntuacion = Rutinapuntuacion::find($idRutinaHasPuntuacion);
        if($objRutinaHasPuntuacion == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, Rutinapuntuacion no encontrado']);
        }
        try {
            $objRutinaHasPuntuacion->delete();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true]);
    }

    public function getAllPuntuaciones() {

    }
}

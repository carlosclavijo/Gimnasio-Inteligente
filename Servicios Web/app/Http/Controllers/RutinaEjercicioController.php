<?php

namespace App\Http\Controllers;

use App\Models\Rutinaejercicio;
use Illuminate\Http\Request;

class RutinaEjercicioController extends Controller
{
    public function index()
    {
        try {
            $ListRutinaHasEjercicios = Rutinaejercicio::all();
        }
        catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Length' => count($ListRutinaHasEjercicios), 'RutinaHasEjercicios' => $ListRutinaHasEjercicios]);
    }

    public function show($idRutinaHasEjercicio)
    {
        try {
            $objRutinaHasEjercicio = Rutinaejercicio::find($idRutinaHasEjercicio);
            if($objRutinaHasEjercicio == null) {
                return response()->json(['Response' => false, 'Message' => 'Error, RutinaHasEjercicio no encontrado']);
            }
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'RutinaHasEjercicio' => $objRutinaHasEjercicio]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->json()->all(), [
            'idRutina' => ['required', 'integer'],
            'idEjercicio' => ['required', 'integer']
        ]);
        if($validator->fails()) {
            return response()->json(["Response" => false, "validator" => $validator->messages()]);
        }
        $objRutinaHasEjercicio = new Rutinaejercicio();
        $objRutinaHasEjercicio->idRutina = $request->json("idRutina");
        $objRutinaHasEjercicio->idEjercicio =  $request->json("idEjercicio");
        try {
            $objRutinaHasEjercicio->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => $e]);
        }
        return response()->json(['Response' => true,  'id' => $objRutinaHasEjercicio->id, 'RutinaHasEjercicio' => $objRutinaHasEjercicio]);
    }

    public function update(Request $request, $idRutinaHasEjercicio)
    {
        $objRutinaHasEjercicio = Rutinaejercicio::find($idRutinaHasEjercicio);
        if($objRutinaHasEjercicio == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, RutinaHasEjercicio no encontrado']);
        }
        if($request->json('idRutina') != null) {
            $objRutinaHasEjercicio->idRutina = $request->json('idRutina');
        }
        if($request->json('idEjercicio') != null) {
            $objRutinaHasEjercicio->idEjercicio = $request->json('idEjercicio');
        }
        try {
            $objRutinaHasEjercicio->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Ha sucedido un error']);
        }
        return response()->json(['Response' => true, 'RutinaHasEjercicios' => $objRutinaHasEjercicio]);
    }

    public function destroy($idRutinaHasEjercicio)
    {
        $objRutinaHasEjercicio = Rutinaejercicio::find($idRutinaHasEjercicio);
        if($objRutinaHasEjercicio == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, RutinaHasEjercicio no encontrado']);
        }
        try {
            $objRutinaHasEjercicio->delete();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true]);
    }
}

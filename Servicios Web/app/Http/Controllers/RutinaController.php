<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use App\Models\Rutina;
use App\Models\Rutinaejercicio;
use App\Models\User;
use Illuminate\Http\Request;

class RutinaController extends Controller
{
    public function index()
    {
        try {
            $listaRutinas = Rutina::all();
            foreach ($listaRutinas as $item) {
                $item->nombreCreador = User::find($item->idCreador)->name;
                $ejerciciosId = Rutinaejercicio::where('idRutina', '=', $item->id)->pluck('idEjercicio');
                $ejercicioArray = array();
                foreach ($ejerciciosId as $eId) {
                    array_push($ejercicioArray, Ejercicio::find($eId));
                }
                foreach ($ejercicioArray as $eArr) {
                    $eArr->nombreCreador = User::find($item->idCreador)->name;
                }
                $item->ejercicios = $ejercicioArray;
            }
        }
        catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => $e]);
        }
        return response()->json(['Response' => true, 'Length' => count($listaRutinas), 'Rutinas' => $listaRutinas]);
    }

    public function show($idRutina)
    {
        try {
            $objRutina = Rutina::find($idRutina);
            if($objRutina == null) {
                return response()->json(['Response' => false, 'Message' => 'Error, Rutina no encontrado']);
            }
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Rutina' => $objRutina]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->json()->all(), [
            'nombre' => ['required', 'string'],
            'visibilidad' => ['required', 'integer', 'min:0', 'max:2'],
            'descripcion' => ['string'],
            'idCreador' => ['required', 'integer'],
        ]);
        if($validator->fails()) {
            return response()->json(["Response" => false, "validator" => $validator->messages()]);
        }
        $objRutina = new Rutina();
        $objRutina->nombre = $request->json("nombre");
        $objRutina->visibilidad =  $request->json("visibilidad");
        $objRutina->descripcion = $request->json("descripcion");
        $objRutina->idCreador =  $request->json("idCreador");
        try {
            $objRutina->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => $e]);
        }
        return response()->json(['Response' => true,  'id' => $objRutina->id, 'Rutina' => $objRutina]);
    }

    public function update(Request $request, $idRutina)
    {
        $objRutina = Rutina::find($idRutina);
        if($objRutina == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, Rutina no encontrado']);
        }
        if($request->json('nombre') != null) {
            $objRutina->nombre = $request->json('nombre');
        }
        if($request->json('visibilidad') != null) {
            $objRutina->visibilidad = $request->json('visibilidad');
        }
        if($request->json('descripcion') != null) {
            $objRutina->visibilidad = $request->json('visibilidad');
        }
        if($request->json('idCreador') != null) {
            $objRutina->idCreador = $request->json('idCreador');
        }
        try {
            $objRutina->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Ha sucedido un error']);
        }
        return response()->json(['Response' => true, 'Rutinas' => $objRutina]);
    }

    public function destroy($idRutina)
    {
        $objRutina = Rutina::find($idRutina);
        if($objRutina == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, Rutina no encontrado']);
        }
        try {
            $objRutina->delete();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true]);
    }
}

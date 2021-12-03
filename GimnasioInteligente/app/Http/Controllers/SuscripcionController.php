<?php

namespace App\Http\Controllers;

use App\Models\Suscripcion;
use Illuminate\Http\Request;

class SuscripcionController extends Controller
{
    public function index()
    {
        try {
            $ListSuscripcion = Suscripcion::all();
        }
        catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Length' => count($ListSuscripcion), 'Suscripcion' => $ListSuscripcion]);
    }

    public function show($idSuscripcion)
    {
        try {
            $objSuscripcion = Suscripcion::find($idSuscripcion);
            if($objSuscripcion == null) {
                return response()->json(['Response' => false, 'Message' => 'Error, Suscripcion no encontrado']);
            }
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Suscripcion' => $objSuscripcion]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->json()->all(), [
            'idUsuario' => ['required', 'integer'],
            'idSuscripcion' => ['required', 'integer'],
        ]);
        if($validator->fails() || $request->json("idUsuario") == $request->json("idSuscripcion")) {
            return response()->json(["Response" => false, "validator" => $validator->messages()]);
        }
        $objSuscripcion = new Suscripcion();
        $objSuscripcion->idUsuario = $request->json("idUsuario");
        $objSuscripcion->idSuscripcion = $request->json("idSuscripcion");
        try {
            $objSuscripcion->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => $e]);
        }
        return response()->json(['Response' => true,  'id' => $objSuscripcion->id, 'Suscripcion' => $objSuscripcion]);
    }

    public function update(Request $request, $idSuscripcion)
    {
        $objSuscripcion = Suscripcion::find($idSuscripcion);
        if($objSuscripcion == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, Suscripcion no encontrado']);
        }
        if($request->json('idUsuario') != null) {
            $objSuscripcion->idUsuario = $request->json('idUsuario');
        }
        if($request->json('idSuscripcion') != null) {
            $objSuscripcion->idSuscripcion = $request->json('idSuscripcion');
        }
        try {
            $objSuscripcion->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Ha sucedido un error']);
        }
        return response()->json(['Response' => true, 'Suscripcion' => $objSuscripcion]);
    }

    public function destroy($idSuscripcion)
    {
        $objSuscripcion = Suscripcion::find($idSuscripcion);
        if($objSuscripcion == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, Suscripcion no encontrado']);
        }
        try {
            $objSuscripcion->delete();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true]);
    }
}

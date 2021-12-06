<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;

class FotoController extends Controller
{
    public function index()
    {
        try {
            $ListFotos = Foto::all();
        }
        catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Length' => count($ListFotos), 'Fotos' => $ListFotos]);
    }

    public function show($idFoto)
    {
        try {
            $objFoto = Foto::find($idFoto);
            if($objFoto == null) {
                return response()->json(['Response' => false, 'Message' => 'Error, Foto no encontrado']);
            }
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Foto' => $objFoto]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->json()->all(), [
            'idEjercicio' => ['required', 'integer'],
            'direccion' => ['required', 'string'],
        ]);
        if($validator->fails()) {
            return response()->json(["Response" => false, "validator" => $validator->messages()]);
        }
        $objFoto = new Foto();
        $objFoto->idEjercicio = $request->json("idEjercicio");
        $objFoto->direccion = $request->json("direccion");
        try {
            $objFoto->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => $e]);
        }
        return response()->json(['Response' => true,  'id' => $objFoto->id, 'Foto' => $objFoto]);
    }

    public function update(Request $request, $idFoto)
    {
        $objFoto = Foto::find($idFoto);
        if($objFoto == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, Foto no encontrado']);
        }
        if($request->json('idEjercicio') != null) {
            $objFoto->idEjercicio = $request->json('idEjercicio');
        }
        if($request->json('direccion') != null) {
            $objFoto->direccion = $request->json('direccion');
        }
        try {
            $objFoto->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Ha sucedido un error']);
        }
        return response()->json(['Response' => true, 'Fotos' => $objFoto]);
    }

    public function destroy($idFoto)
    {
        $objFoto = Foto::find($idFoto);
        if($objFoto == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, Foto no encontrado']);
        }
        try {
            $objFoto->delete();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true]);
    }

}

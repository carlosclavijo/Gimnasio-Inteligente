<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    public function index()
    {
        try {
            $ListNotificacion = Notificacion::all();
        }
        catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Length' => count($ListNotificacion), 'Notificacion' => $ListNotificacion]);
    }

    public function show($idNotificacion)
    {
        try {
            $objNotificacion = Notificacion::find($idNotificacion);
            if($objNotificacion == null) {
                return response()->json(['Response' => false, 'Message' => 'Error, Notificacion no encontrado']);
            }
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Notificacion' => $objNotificacion]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->json()->all(), [
            'idUsuario' => ['required', 'integer'],
            'titulo' => ['required', 'string'],
            'descripcion' => ['required', 'string'],
        ]);
        if($validator->fails() || $request->json("idUsuario") == $request->json("idNotificacion")) {
            return response()->json(["Response" => false, "validator" => $validator->messages()]);
        }
        $objNotificacion = new Notificacion();
        $objNotificacion->idUsuario = $request->json("idUsuario");
        $objNotificacion->titulo = $request->json("titulo");
        $objNotificacion->descripcion = $request->json("descripcion");
        try {
            $objNotificacion->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => $e]);
        }
        return response()->json(['Response' => true,  'id' => $objNotificacion->id, 'Notificacion' => $objNotificacion]);
    }

    public function update(Request $request, $idNotificacion)
    {
        $objNotificacion = Notificacion::find($idNotificacion);
        if($objNotificacion == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, Notificacion no encontrado']);
        }
        if($request->json('idUsuario') != null) {
            $objNotificacion->idUsuario = $request->json('idUsuario');
        }
        if($request->json('titulo') != null) {
            $objNotificacion->titulo = $request->json('titulo');
        }
        if($request->json('descripcion') != null) {
            $objNotificacion->descripcion = $request->json('descripcion');
        }
        try {
            $objNotificacion->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Ha sucedido un error']);
        }
        return response()->json(['Response' => true, 'Notificacion' => $objNotificacion]);
    }

    public function destroy($idNotificacion)
    {
        $objNotificacion = Notificacion::find($idNotificacion);
        if($objNotificacion == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, Notificacion no encontrado']);
        }
        try {
            $objNotificacion->delete();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true]);
    }
}

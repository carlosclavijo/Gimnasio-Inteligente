<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use Illuminate\Http\Request;

class EjercicioController extends Controller
{
    public function index()
    {
        try {
            $ListEjercicios = Ejercicio::all();
        }
        catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Length' => count($ListEjercicios), 'Ejercicios' => $ListEjercicios]);
    }

    public function show($idEjercicio)
    {
        try {
            $objEjercicio = Ejercicio::find($idEjercicio);
            if($objEjercicio == null) {
                return response()->json(['Response' => false, 'Message' => 'Error, Ejercicio no encontrado']);
            }
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Ejercicio' => $objEjercicio]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->json()->all(), [
            'nombre' => ['required', 'string'],
            'musculos' => ['required', 'string'],
            'descripcion' => ['required', 'string'],
            'video' => ['string'],
            'idCreador' => ['required', 'integer']
        ]);
        if($validator->fails()) {
            return response()->json(["Response" => false, "validator" => $validator->messages()]);
        }
        $objEjercicio = new Ejercicio();
        $objEjercicio->nombre = $request->json("nombre");
        $objEjercicio->musculos = $request->json("musculos");
        $objEjercicio->descripcion = $request->json("descripcion");
        $objEjercicio->video = $request->json("video");
        $objEjercicio->idCreador = $request->json("idCreador");
        try {
            $objEjercicio->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => $e]);
        }
        return response()->json(['Response' => true,  'id' => $objEjercicio->id, 'Ejercicio' => $objEjercicio]);
    }

    public function update(Request $request, $idEjercicio)
    {
        $objEjercicio = Ejercicio::find($idEjercicio);
        if($objEjercicio == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, Ejercicio no encontrado']);
        }
        if($request->json('nombre') != null) {
            $objEjercicio->nombre = $request->json('nombre');
        }
        if($request->json('musculos') != null) {
            $objEjercicio->musculos = $request->json('musculos');
        }
        if($request->json('descripcion') != null) {
            $objEjercicio->descripcion = $request->json('descripcion');
        }
        if($request->json('video') != null) {
            $objEjercicio->video = $request->json('video');
        }
        try {
            $objEjercicio->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Ha sucedido un error']);
        }
        return response()->json(['Response' => true, 'Ejercicios' => $objEjercicio]);
    }

    public function destroy($idEjercicio)
    {
        $objEjercicio = Ejercicio::find($idEjercicio);
        if($objEjercicio == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, Ejercicio no encontrado']);
        }
        try {
            $objEjercicio->delete();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true]);
    }

    public function subirFoto($publicacionId) {
        $response = array();
        $upload_dir = './'.$publicacionId. '/';
        $server_url = 'http://127.0.0.1:8000';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        foreach($_FILES["imagen"]["tmp_name"] as $key => $tmp_name)
        {
            if ( $_FILES['imagen']["name"][$key] ) {
                $avatar_name = $_FILES["imagen"]["name"][$key];
                $avatar_tmp_name = $_FILES["imagen"]["tmp_name"][$key];
                $error = $_FILES["imagen"]["error"][$key];

                if($error > 0){
                    $response = array(
                        "status" => "error",
                        "error" => true,
                        "message" => "Error uploading the file!"
                    );
                } else {
                    // $random_name = rand(1000,100000000)."-".$avatar_name;
                    $random_name = $avatar_name;
                    $upload_name = $upload_dir.strtolower($random_name);
                    // $upload_name = preg_replace('/\s+/', '-', $upload_name);

                    if(move_uploaded_file($avatar_tmp_name , $upload_name)) {
                        $response = array(
                            "status" => 200,
                            "error" => false,
                            "mensaje" => "Se Subio Exitosamen la imagen"
                        );
                    }else
                    {
                        $response = array(
                            "status" => 500,
                            "error" => true,
                            "mensaje" => "Error uploading the file!"
                        );
                    }
                }
            } else{
                $response = array(
                    "status" => 500,
                    "error" => true,
                    "mensaje" => "No file was sent!"
                );
            }
        }
        echo json_encode($response);
    }
}

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

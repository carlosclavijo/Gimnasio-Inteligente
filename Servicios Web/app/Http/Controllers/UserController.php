<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        try {
            $listUsers = User::all();
        }
        catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Length' => count($listUsers), 'Users' => $listUsers]);
    }

    public function show($idUser)
    {
        try {
            $objUser = User::find($idUser);
            if($objUser == null) {
                return response()->json(['Response' => false, 'Message' => 'Error, User no encontrado']);
            }
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'User' => $objUser]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->json()->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
        if($validator->fails()) {
            return response()->json(["Response" => false, "validator" => $validator->messages()]);
        }
        $objUser = new User();
        $objUser->name = $request->json("name");
        $objUser->email =  $request->json("email");
        $objUser->password =  $request->json("password");
        try {
            $objUser->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => "Error"]);
        }
        return response()->json(['Response' => true, 'Message' => "Su registro fue exitoso", 'Id' => $objUser->id, 'User' => $objUser]);
    }

    public function update(Request $request, $idUser)
    {
        $objUser = User::find($idUser);
        if($objUser == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, User no encontrado']);
        }
        if($request->json('name') != null) {
            $objUser->name = $request->json('name');
        }
        if($request->json('email') != null) {
            $objUser->email = $request->json('email');
        }
        if($request->json('password') != null) {
            $objUser->password = $request->json('password');
        }
        try {
            $objUser->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Ha sucedido un error']);
        }
        return response()->json(['Response' => true, 'Users' => $objUser]);
    }

    public function destroy($idUser)
    {
        $objUser = User::find($idUser);
        if($objUser == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, User no encontrado']);
        }
        try {
            $objUser->delete();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true]);
    }

    public function login(Request $request)
    {
        $validator = \Validator::make($request->json()->all(), [
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
        if($validator->fails()) {
            return response()->json(["Response" => false, "validator" => $validator->messages()]);
        }
        $listUsers = User::all();
        foreach ($listUsers as  $user) {
            if($user->email == $request->json("email") && $user->password == $request->json("password")) {
                return response()->json(['Response' => true, 'Message' => "Login exitoso", 'id' => $user->id]);
            } else if($user->email == $request->json("email") && $user->password != $request->json("password")) {
                return response()->json(['Response' => false, 'Message' => "Contraseña incorrecta", 'id' => $user->id]);
            }
            return response()->json(['Response' => false, 'Message' => "No pudo ingresar", 'Id' => $user->id]);
        }
    }

}

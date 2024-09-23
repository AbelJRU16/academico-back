<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $inputs["password"] = Hash::make(trim($inputs["password"]));
        $response = User::create($inputs);
        return response()->json([
            'data'=>$response,
            'message'=> 'Usuario creado.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if(isset($user)){
            return response()->json([
                'data'=>$user,
                'message'=> 'Usuario encontrado.'
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'message'=> 'No existe el usuario.'
            ]);            
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if(isset($user)){
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            if($user->save()){
                return response()->json([
                    'data'=>$user,
                    'message'=> 'Usuario actualizado con exito.'
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'message'=> 'No se actualizo el usuario.'
                ]);                
            }
        }else{
            return response()->json([
                'error'=>true,
                'message'=> 'No existe el usuario.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if(isset($user)){
            $response = User::destroy($id);
            if($response){
                return response()->json([
                    'data'=>$user,
                    'message'=> 'Usuario eliminado con exito.'
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'message'=> 'No se pudo eliminar el usuario.'
                ]);                    
            }
        }else{
            return response()->json([
                'error'=>true,
                'message'=> 'No existe el usuario.'
            ]);            
        }
    }
}

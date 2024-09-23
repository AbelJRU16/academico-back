<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Estudiante::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $response = Estudiante::create($inputs);
        return response()->json([
            'data'=>$response,
            'message'=> 'Estudiante creado.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $estudiante = Estudiante::find($id);
        if(isset($estudiante)){
            return response()->json([
                'data'=>$estudiante,
                'message'=> 'Estudiante encontrado.'
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'message'=> 'No existe el estudiante.'
            ]);            
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $estudiante = Estudiante::find($id);
        if(isset($estudiante)){
            $estudiante->nombre = $request->nombre;
            $estudiante->apellido = $request->apellido;
            $estudiante->foto = $request->foto;
            if($estudiante->save()){
                return response()->json([
                    'data'=>$estudiante,
                    'message'=> 'Estudiante actualizado con exito.'
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'message'=> 'No se actualizo el estudiante.'
                ]);                
            }
        }else{
            return response()->json([
                'error'=>true,
                'message'=> 'No existe el estudiante.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $estudiante = Estudiante::find($id);
        if(isset($estudiante)){
            $response = Estudiante::destroy($id);
            if($response){
                return response()->json([
                    'data'=>$estudiante,
                    'message'=> 'Estudiante eliminado con exito.'
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'message'=> 'No se pudo eliminar el estudiante.'
                ]);                    
            }
        }else{
            return response()->json([
                'error'=>true,
                'message'=> 'No existe el estudiante.'
            ]);            
        }
    }
}

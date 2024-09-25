<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Curso::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $response = Curso::create($inputs);
        return response()->json([
            'data'=>$response,
            'message'=> 'Curso creado.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $curso = Curso::find($id);
        if(isset($curso)){
            return response()->json([
                'data'=>$curso,
                'message'=> 'Curso encontrado.'
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'message'=> 'No existe el curso.'
            ]);            
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $curso = Curso::find($id);
        if(isset($curso)){
            $curso->nombre = $request->nombre;
            $curso->horas = $request->horas;
            if($curso->save()){
                return response()->json([
                    'data'=>$curso,
                    'message'=> 'Curso actualizado con exito.'
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'message'=> 'No se actualizo el curso.'
                ]);                
            }
        }else{
            return response()->json([
                'error'=>true,
                'message'=> 'No existe el curso.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $curso = Curso::find($id);
        if(isset($curso)){
            $response = Curso::destroy($id);
            if($response){
                return response()->json([
                    'data'=>$curso,
                    'message'=> 'Curso eliminado con exito.'
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'message'=> 'No se pudo eliminar el $curso.'
                ]);                    
            }
        }else{
            return response()->json([
                'error'=>true,
                'message'=> 'No existe el curso.'
            ]);            
        }
    }
}

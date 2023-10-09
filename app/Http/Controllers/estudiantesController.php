<?php

namespace App\Http\Controllers;

use App\Models\estudiante;
use Illuminate\Http\Request;

class estudiantesController extends Controller
{

    public function index (){
        return estudiante::all();
    }

    public function store(Request $request){

        $inputs = $request->input();    
        $e = estudiante::create($inputs);
        return response()->json([
            'data'=>$e,
            'mensaje'=>"Estuadiante actualizado con exito.",
        ]);
    }

    public function show ($id){
          
        $e = estudiante::find($id);
        if (isset($e)){
            return response()->json([
                'data'=>$e,
                'mensaje'=>"Estudiante encontrado con exito",
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'mensaje'=>"No existe el estudiante.",
            ]);
        }
    }

    public function update(Request $request, $id){

        $e = estudiante::find($id);
        if (isset($e)){
            $e->nombre = $request -> nombre;
            $e->apellido = $request -> apellido;
            $e->foto = $request -> foto;
            if($e->save()){
                return response()->json([
                    'data'=>$e,
                    'mensaje'=>"Estuadiante actualizado con exito.",
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'mensaje'=>"No se actualizó estudiante",
                ]);    
            };        
        }else{
            return response()->json([
                'error'=>true,
                'mensaje'=>"No existe el estudiante.",
            ]);
        };
    }

    public function destroy ($id){
        $e = estudiante::find($id);
        if (isset($e)){
            $resp = estudiante::destroy($id);
            if($resp){
                return response()->json([
                    'data'=>$e,
                    'mensaje'=>"Estudiante eliminado con exito",
                ]);
            }else{
                return response()->json([
                    'data'=>$e,
                    'mensaje'=>"Estudiante no existe",
                ]);
            }           
        }else{
            return response()->json([
                'error'=>true,
                'mensaje'=>"No existe el estudiante.",
            ]);
        }
    }
}


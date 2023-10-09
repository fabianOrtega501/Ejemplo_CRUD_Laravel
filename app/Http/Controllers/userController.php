<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
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
        $inputs["password"] = Hash::make(trim($request -> foto));    
        $e = user::create($inputs);
        return response()->json([
            'data'=>$e,
            'mensaje'=>"Registrado con exito.",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $e = User::find($id);
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $e = user::find($id);
        if (isset($e)){
            $e->first_name = $request -> first_name;
            $e->last_name = $request -> last_name;
            $e->email = $request -> email;
            $e->password = Hash::make($request -> foto);
            if($e->save()){
                return response()->json([
                    'data'=>$e,
                    'mensaje'=>"Actualizado con exito.",
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'mensaje'=>"No se actualizó",
                ]);    
            };        
        }else{
            return response()->json([
                'error'=>true,
                'mensaje'=>"No existe",
            ]);
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $e = user::find($id);
        if (isset($e)){
            $resp = user::destroy($id);
            if($resp){
                return response()->json([
                    'data'=>$e,
                    'mensaje'=>"Eliminado con exito",
                ]);
            }else{
                return response()->json([
                    'data'=>$e,
                    'mensaje'=>"No existe",
                ]);
            }           
        }else{
            return response()->json([
                'error'=>true,
                'mensaje'=>"No existe",
            ]);
        }
    }
}

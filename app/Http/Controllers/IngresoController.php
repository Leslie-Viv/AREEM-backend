<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Ingreso;
use App\Models\ArchivarIngreso;

class IngresoController extends Controller
{
    public function veringreso () {
        $ingresos= Ingreso::all();
        return response()-> json($ingresos);
    }

    public function create(Request $request) {
        $validator= Validator::make($request->all(),[
            'nombrecompleto'=> 'required | string',
            'nombreunidad'=> 'required | string',
            'anomesdereporte'=> 'required',
            'producto'=> 'required | string',
            'fechareal'=> 'required',
            'montototal'=> 'required | string',
            'user_id'=> 'required',
        ]);

        //**Valida los campos requeridos */
        if($validator->fails()){
            return response ()-> json(['error'=>$validator->errors()],422);
        }
        $ingreso=Ingreso::create($request->all());

        //** 200 Valida que el registro fue satisfactorio*/

        return response ($ingreso,200);

    }

    public function update(Request $request, $id){
        //**Validación de id */
        $ingreso=Ingreso::find($id);
        if(!$ingreso){
            return response ()-> json(['error'=>'Ingreso no encontrado'],404);
        }

        $ingreso->update($request->all());

        return response()-> json($ingreso,200);

        
    }

    // public function archivar($id) {
    //     try {
    //         // Paso 1: Obtener el registro de Ingreso
    //         $ingreso = Ingreso::findOrFail($id);
            
    //         // Paso 2: Crear un nuevo registro en ArchivarIngreso
    //         $archivarIngreso = new ArchivarIngreso();
    //         $archivarIngreso->fill($ingreso->toArray()); // Copiar los datos del ingreso
    //         $archivarIngreso->save();

    //         // Paso 3: Eliminar el registro de Ingreso original
    //         $ingreso->delete();

    //         return response()->json(['message' => 'Ingreso archivado correctamente'], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Error al archivar el ingreso'], 500);
    //     }
    // }

    //
    
}

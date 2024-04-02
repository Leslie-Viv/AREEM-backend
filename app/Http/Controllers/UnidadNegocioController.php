<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UnidadNegocio;

class UnidadNegocioController extends Controller
{
    //
    //**Ver unidad */

    public function verunidad () {
        $unidad_negocios= UnidadNegocio::all();
        return response()-> json($unidad_negocios);
    }

     //**Crear unidad */
     public function crearunidad(Request $request) {
        $validator= Validator::make($request->all(),[
            'nombreunidad'=> 'required | string | min:3 | max:30',
        ]);

        //**Valida los campos requeridos */
        if($validator->fails()){
            return response ()-> json(['error'=>$validator->errors()],422);
        }
        $unidad_negocios=UnidadNegocio::create($request->all());

        //** 200 Valida que el registro fue satisfactorio*/

        return response ($unidad_negocios,200);

    }

    //**Edita unidad */

    public function editarunidad(Request $request, $id){
        //**Validación de id */
        $unidad_negocios=UnidadNegocio::find($id);
        if(!$unidad_negocios){
            return response ()-> json(['error'=>'Unidad no encontrada'],404);
        }

        $unidad_negocios->update($request->all());

        return response()-> json($unidad_negocios,200);

        
    }
    


}

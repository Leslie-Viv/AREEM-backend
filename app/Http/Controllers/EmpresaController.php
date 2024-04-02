<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    //

     //**Ver empresa*/

     public function verempresa () {
        $empresas= Empresa::all();
        return response()-> json($empresas);
    }

     //**Crear empresa */
     public function crearempresa(Request $request) {
        $validator= Validator::make($request->all(),[
            'nombreempresa'=> 'required | string',
        ]);

        //**Valida los campos requeridos */
        if($validator->fails()){
            return response ()-> json(['error'=>$validator->errors()],422);
        }
        $empresas=Empresa::create($request->all());

        //** 200 Valida que el registro fue satisfactorio*/

        return response ($empresas,200);

    }

    //**Edita empresa*/

    public function editarempresa(Request $request, $id){
        //**Validación de id */
        $empresas=Empresa::find($id);


        if(!$empresas){
            return response ()-> json(['error'=>'Empresa no encontrada'],404);
        }

        $empresas->update($request->all());

        return response()-> json($empresas,200);

        
    }

    public function obtenerEmpresaPorId($id)
{
    // Usando el método find()
    $empresa = Empresa::find($id);

    // Usando el método findOrFail(), lanzará una excepción si no se encuentra la empresa
    // $empresa = Empresa::findOrFail($id);

    if (!$empresa) {
        return response()->json(['message' => 'Empresa no encontrada'], 404);
    }

    return response()->json($empresa);
}

}

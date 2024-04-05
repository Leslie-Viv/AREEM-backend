<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Producto;



class ProductoController extends Controller
{
    //**Ver producto */

    public function verproducto () {
        $productos= Producto::all();
        return response()-> json($productos);
    }
    //

    //**Crear producto */
    public function crearproducto(Request $request) {
        $validator= Validator::make($request->all(),[
            'producto'=> 'required | string |min:3|max:30',
        ]);

        //**Valida los campos requeridos */
        if($validator->fails()){
            return response ()-> json(['error'=>$validator->errors()],422);
        }
        $producto=Producto::create($request->all());

        //** 200 Valida que el registro fue satisfactorio*/

        return response ($producto,200);

    }

    //**Edita producto */

    public function editarproducto(Request $request, $id){
        //**Validación de id */
        $producto=Producto::find($id);
        if(!$producto){
            return response ()-> json(['error'=>'Producto no encontrado'],404);
        }

        $producto->update($request->all());

        return response()-> json($producto,200);

        
    }

    public function eliminarproducto($id){
        $producto= Producto::find($id);
        if(is_null($producto)){
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        $producto->delete();
        return response()->json(['message' => 'Producto eliminado exitosamente'], 200);
    }

    public function obtenerProductoPorId($id)
    {
        // Usando el método find()
        $producto = Producto::find($id);
    
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
    
        return response()->json($producto);
    }
    

}

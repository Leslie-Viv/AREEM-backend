<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Gerente
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth('api')->user()) {
            $rol_id = auth('api')->user()->rol_id;

            if ($rol_id === 2) { //compara que ambos datos sean de un mismo tipo es decir, 1 tipo int === a 1 tipo int, en cambio 1 tipo string == a 1 tipo string
                return $next($request); // Si es gerente, permite continuar al HOME.
            } elseif ($rol_id === 1) {
                return redirect('onlyadmin'); // Si es admin lo manda a Administrador.
            } elseif ($rol_id === 3) {
                return redirect('onlyfinanzas'); // Si es finanzas lo manda a Finanzas.
            } else {
                return response(['message' => 'Este rol no exite en la DB'], 401);
            }
        } else {
            return response(['message' => 'No estas autenticado'], 401);
        }
    
    }
}

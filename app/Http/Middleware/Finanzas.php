<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Finanzas
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

            if ($rol_id === 3) { //compara que ambos datos sean de un mismo tipo es decir, 1 tipo int === a 1 tipo int, en cambio 1 tipo string == a 1 tipo string
                return $next($request); // Si es Finanzas, permite continuar al HOME.
            } elseif ($rol_id === 2) {
                return redirect('onlygerente'); // Si es gerente lo manda a Gerente.
            } elseif ($rol_id === 1) {
                return redirect('onlyadmin'); // Si es administrador lo manda a Administrador.
            } else {
                return response(['message' => 'Este rol no existe en la DB'], 401);
            }
        } else {
            return response(['message' => 'No estas autenticado'], 401);
        }
    }
}

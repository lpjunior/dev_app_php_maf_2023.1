<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ClientProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check() || !Auth::user()->isClient())
        {
            // Se o usuário não estiver logado ou não for um cliente, é redicionado para a rota de home
            return redirect('home');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Client\Request;

class Cors
{
    /**
     * CORS = Cross-Origin Resource Sharing.
     * A configuração do CORS é feita para permitir que seu aplicativo responsa a solicitações de diferentes domínios.
     *
     * Access-Control-Allow-Origin: Especifica quais domínios podem acessar recursos do seu servidor. O asteristico(*) permite qualquer domínio.
     * Uma boa prática é definir quais domínios devem acessar a aplicação no ambiente de produção.
     *
     * Access-Control-Allow-Methods: Indica quais métodos HTTP permitods para acesso cross-origin
     *
     * Access-Control-Allow-Headers: Indica quais cabeçalhos(headers) HTTP podem ser usados durante a solicitação.
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Cabeçalhos (headers) necessários para habilitar CORS
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorize, X-Requested-With');

        return $response;
    }
}

<?php

namespace Automacao\Http\Middleware;

use Closure;

class HttpsProtocolo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $local = (getenv('APP_ENV') == 'local');

        if (!$request->secure()  && !$local) {

            return redirect()->secure($request->getRequestUri());

        }
        
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RequestLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::channel("requests")->info('Request', [
            "method" => $request->method(),
            "url" => $request->path(),
            "ip" => $request->ip(),
            "body" => $request->all(),
        ]);
        return $next($request);
    }
}

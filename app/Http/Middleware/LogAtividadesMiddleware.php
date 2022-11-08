<?php

namespace App\Http\Middleware;

use App\Models\LogAtividades;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogAtividadesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->method() != 'GET') {
            LogAtividades::create([
                'user_id' => Auth::user()->id,
                'method' => $request->method(),
                'request_uri' => $request->getRequestUri(),
                'remote_addr' => $request->ip(),
            ]);
        }
        return $next($request);
    }
}

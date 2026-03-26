<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        if ($request->user()->isSuperAdmin()) {
            return $next($request);
        }

        if (!$request->user()->hasPermission($permission)) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }
}

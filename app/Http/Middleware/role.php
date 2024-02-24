<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $userRole = $request->user()->role;

        if ($userRole === 'user' && $role !== 'user') {
            return redirect('dashboard');
        } else if ($userRole === 'admin' && $role === 'user') {
            return redirect('/admin/dashboard');
        } else if ($userRole === 'instructor' && $role === 'user') {
            return redirect('/instructor/dashboard');
        } else if ($userRole === 'admin' && $role === 'instructor') {
            return redirect('/admin/dashboard');
        } else if ($userRole === 'instructor' && $role === 'admin') {
            return redirect('/instructor/dashboard');
        }

        return $next($request);
    }
}

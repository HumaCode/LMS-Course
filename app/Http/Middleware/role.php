<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {

        // cek status online/offline
        if (Auth::check()) {
            $expireTime = Carbon::now()->addSeconds(30);
            Cache::put('user-is-online' . Auth::user()->id, true, $expireTime);
            User::where('id', Auth::user()->id)->update([
                'last_seen' => Carbon::now(),
            ]);
        }


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

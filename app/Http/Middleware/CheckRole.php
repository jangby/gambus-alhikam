<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user punya role yang sesuai dengan yang diminta
        if (!in_array($request->user()->role, $roles)) {
            
            // Jika Member nyasar ke halaman Admin, lempar ke dashboard member
            if ($request->user()->role == 'member') {
                return redirect()->route('member.dashboard');
            }

            // Jika Admin nyasar, lempar ke dashboard admin
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
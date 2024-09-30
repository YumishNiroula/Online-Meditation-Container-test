<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request)  $next
     * @param  string  ...  $roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $excludedRoleId = 2;

        // Check if user has any role except the excluded ones
        if (!Auth::user()->roles->pluck('name')->contains('Customer') && auth()->user()->role_id !== $excludedRoleId) {
            return $next($request);
        }

        return abort(403, 'Unauthorized'); // Or throw a custom exception
    }
}

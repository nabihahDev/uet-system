<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($role === 'oc' && !str_ends_with($user->email, '@bah.ngam')) {
            abort(403, 'Unauthorized access to OC Panel.');
        }

        if ($role === 'applicant' && !str_ends_with($user->email, '@bah.okay')) {
            abort(403, 'Unauthorized access to Applicant Panel.');
        }

        return $next($request);
    }
}
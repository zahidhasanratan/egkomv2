<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureVendorApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $vendor = $request->user('vendor');
        if (!$vendor || !$vendor->isApproved()) {
            return redirect()->route('vendor-admin.dashboard')
                ->with('error', 'Your account is pending approval. You can update your profile and banking info until then.');
        }
        return $next($request);
    }
}

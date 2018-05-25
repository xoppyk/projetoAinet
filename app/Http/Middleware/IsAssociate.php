<?php

namespace App\Http\Middleware;

use Closure;
use Route;

use App\User;

class IsAssociate
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
        $user = route::current()->parameter('user');
        if (!$user instanceof User) {
            abort(400, 'Some Wrong');
        }
        if ($request->user() && $request->user()->id == $user->id || $request->user()->associatesOf()->get()->contains($user)) {
            return $next($request);
        }
        abort(403, 'Not Authorized');
    }
}

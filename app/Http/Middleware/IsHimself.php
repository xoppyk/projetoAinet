<?php

namespace App\Http\Middleware;

use Closure;
use Route;

use App\User;
class IsHimself
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
        if (isset($user) && !($user instanceof User)) {
            abort(400, 'Something Wrong');
        }
        if ($request->user() && $request->user()->id == $user->id) {
            return $next($request);
        }
        abort(403, 'Not Authorized');
    }
}

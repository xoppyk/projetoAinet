<?php

namespace App\Http\Middleware;

use Closure;
use Route;

use App\Movement;
class OwnerOfMovemente
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
        $movement = route::current()->parameter('movement');
        if (isset($movement) && !($movement instanceof Movement)) {
            abort(400, 'Something Wrong');
        }
        if ($request->user() && $request->user()->id == $movement->account->user->id) {
            return $next($request);
        }
        abort(403, 'Not Authorized');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Route;

use App\Account;

class OwnerOfAccount
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
        $account = route::current()->parameter('account');
        if (isset($account) && !($account instanceof Account)) {
            abort(400, 'Something Wrong');
        }
        if ($request->user() && $request->user()->id == $account->owner_id) {
            return $next($request);
        }
        abort(403, 'Not Authorized');
    }
}

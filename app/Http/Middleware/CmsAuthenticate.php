<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CmsAuthenticate
{
     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'cms')
    {
        if (Auth::guard($guard)->guest()) 
        {
            if ($request->ajax() || $request->wantsJson())
            {
                return response('Unauthorized.', 401);
            }
        }
        else
        {
            if (!empty(Auth::guard($guard)->user()->deleted) || empty(Auth::guard($guard)->user()->is_active))
            {
                Auth::guard($guard)->logout();

                $request->session()->flush();

                $request->session()->regenerate();

                return redirect('/admin');  
            }
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\giver;
class giverMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('givers')->check()){
            $user = giver::find(Auth::guard('givers')->user()->giver_id);
            $user->status = 1;
            $user->save();
            return $next($request);
        }
        else
            return redirect(route('loginGiver'))->with('error','You must be logged in to access this page');
    }
}

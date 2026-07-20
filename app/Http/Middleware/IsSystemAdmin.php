<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class IsSystemAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    protected $auth;
    protected $route;

    public function __construct(Guard $auth, Route $route) {
        $this->auth = $auth;
        $this->route = $route;
    }
    public function handle(Request $request, Closure $next): Response
    {
        // Block students (role_id = 4) from admin dashboard
        // Allow instructors (role_id = 7) with limited access to admin dashboard
        if($this->auth->user()->role_id == 4) {
            return new Response('<div style="margin-top: 130px;"><center><img src="https://forum.hestiacp.com/uploads/default/original/1X/8592157f8ed594f456bb3eefe8660e1e06ec51fc.png"
            alt="login form"/></center></div>', 401);
        }
        return $next($request);
    }
}

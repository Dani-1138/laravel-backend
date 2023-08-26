<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        
        // Set the necessary CORS headers
        $response->header('Access-Control-Allow-Origin', 'http://localhost:3000/login'); // You can replace '*' with your frontend URL if you want to restrict it to a specific domain.
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
        $response->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        return $response;
    }
}


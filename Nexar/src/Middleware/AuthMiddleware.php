<?php

namespace App\Middleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Middleware\MiddlewareInterface;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, callable $next): Response
    {
       
        if (!$this->isAuthenticated($request)) {
            return new Response('Unauthorized', 401);
        }
        
        return $next($request);
    }

    private function isAuthenticated(Request $request): bool
    {
        
        return true; // Exemple simplifié
    }
}
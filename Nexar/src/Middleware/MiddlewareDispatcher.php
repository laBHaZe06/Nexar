<?php

namespace App\Middleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Middleware\MiddlewareInterface;

class MiddlewareDispatcher
{
    private array $middlewares = [];

    public function addMiddleware(MiddlewareInterface $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    public function handle(Request $request, callable $next): Response
    {
        $middleware = array_shift($this->middlewares);
        if ($middleware === null) {
            return $next($request);
        }

        return $middleware->handle($request, function (Request $request) use ($next) {
            return $this->handle($request, $next);
        });
    }
}
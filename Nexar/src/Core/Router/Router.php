<?php

namespace App\Router;

class Router
{
    private array $routes = [];

    public function addRoute(Route $route): void
    {
        $this->routes[] = $route;
    }

    public function getRoute(string $path): ?Route
    {
        foreach ($this->routes as $route) {
            if ($route->getPath() === $path) {
                return $route;
            }
        }
        return null;
    }

    public function dispatch(string $path)
    {
        $route = $this->getRoute($path);
        if ($route) {
            $controllerName = $route->getController();
            $action = $route->getAction();
            $controller = new $controllerName();
            return $controller->$action();
        } else {
            http_response_code(404);
            echo '404 Not Found';
        }
    }
}
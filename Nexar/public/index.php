<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Middleware\MiddlewareDispatcher;
use App\Middleware\AuthMiddleware;
use App\Router\Route;
use App\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Initialisation du routeur
$router = new Router();
$router->addRoute(new Route('/', 'App\Controller\DefaultController', 'index'));
$router->addRoute(new Route('/about', 'App\Controller\DefaultController', 'about'));
$router->addRoute(new Route('/user/{id}', 'App\Controller\UserController', 'show'));

// Initialisation des middlewares
$middlewareDispatcher = new MiddlewareDispatcher();
$middlewareDispatcher->addMiddleware(new AuthMiddleware()); // Ajout du middleware d'authentification

// Récupération du chemin de l'URL demandée
$request = Request::createFromGlobals();
$path = $request->getPathInfo();

// Gestion des middlewares et dispatch de la route correspondante
$response = $middlewareDispatcher->handle($request, function (Request $request) use ($router, $path) {
    ob_start();
    $router->dispatch($path);
    $content = ob_get_clean();
    return new Response($content);
});

// Envoi de la réponse
$response->send();
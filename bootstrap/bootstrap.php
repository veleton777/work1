<?php

use App\Router;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpKernel;

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

define('DOCUMENT_ROOT', dirname(__DIR__));

$router = new Router();
$routes = $router->getRoutes();

$context = new RequestContext();
$request = Request::createFromGlobals();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);
$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();

try {
    $matcher = $matcher->match($request->getPathInfo());

    $matcher['_controller'] .= '::' . $matcher['_route'];
    $request->attributes->add($matcher);

    $controller = $controllerResolver->getController($request);
    $arguments = $argumentResolver->getArguments($request, $controller);

    call_user_func_array($controller, $arguments);
} catch (ResourceNotFoundException $e) {
    header('HTTP/1.0 404 Not Found');

    echo 'Not Found!';
}
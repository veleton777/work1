<?php

namespace App;

use App\Controller\IndexController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Router
{
    private $routes;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * @return mixed
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    private function init(): void
    {
        $this->routes = new RouteCollection();
        $this->routes->add(
            'form', new Route(
                '/form', [
                '_controller' => IndexController::class
                ]
            )
        );
        $this->routes->add(
            'formAction', new Route(
                '/form-action', [
                '_controller' => IndexController::class
                ]
            )
        );
    }
}
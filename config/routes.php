<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {

    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {

        // Home real de Xservicios
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'home']);

        // Páginas estáticas (si las necesitas después)
        $builder->connect('/pages/*', 'Pages::display');

        // Fallbacks (solo para desarrollo)
        $builder->fallbacks();
    });
};

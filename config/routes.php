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

        // ==============================
        // XservUsuarios
        // ==============================
        $builder->connect(
            '/xserv-usuarios/profile',
            ['controller' => 'XservUsuarios', 'action' => 'profile']
        );

        $routes->connect('/', [
            'controller' => 'Home',
            'action' => 'index'
        ]);

        
        $builder->connect(
            '/xserv-usuarios',
            ['controller' => 'XservUsuarios', 'action' => 'index']
        );

        $builder->connect(
            '/xserv-usuarios/login',
            ['controller' => 'XservUsuarios', 'action' => 'login']
        );

        $builder->connect(
            '/xserv-usuarios/register',
            ['controller' => 'XservUsuarios', 'action' => 'register']
        );

        $builder->connect(
            '/xserv-usuarios/ver/:id',
            ['controller' => 'XservUsuarios', 'action' => 'view'],
            ['pass' => ['id'], 'id' => '\d+']
        );

        $builder->connect(
            '/xserv-usuarios/agregar',
            ['controller' => 'XservUsuarios', 'action' => 'add']
        );

        $builder->connect(
            '/xserv-usuarios/editar/:id',
            ['controller' => 'XservUsuarios', 'action' => 'edit'],
            ['pass' => ['id'], 'id' => '\d+']
        );

        // Fallbacks (solo para desarrollo)
        $builder->fallbacks();
    });
};

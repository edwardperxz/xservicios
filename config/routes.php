<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

return function (RouteBuilder $routes): void {

    $routes->setRouteClass(DashedRoute::class);
    $routes->setExtensions(['json']);
    Router::extensions(['json']);

    $routes->scope('/', function (RouteBuilder $builder): void {

        // Home real de Xservicios
        //$builder->connect('/', ['controller' => 'Pages', 'action' => 'home']);
        $builder->redirect('/', '/home');
        
        // Rutas Frontend - Debe estar ANTES del fallbacks
        $builder->connect('/home', ['controller' => 'Home', 'action' => 'index']);
        $builder->connect('/home-login', ['controller' => 'Home', 'action' => 'home_login']);
        $builder->connect('/fleet', ['controller' => 'Frontend', 'action' => 'fleet']);
        $builder->connect('/about', ['controller' => 'Frontend', 'action' => 'about']);
        $builder->connect('/signup', ['controller' => 'Frontend', 'action' => 'signup']);
        $builder->connect('/login', ['controller' => 'Frontend', 'action' => 'login']);
        $builder->connect('/newreservation', ['controller' => 'Frontend', 'action' => 'newreservation']);
        $builder->connect('/rateservice', ['controller' => 'Frontend', 'action' => 'rateservice']);
        $builder->connect('/myreservations', ['controller' => 'Frontend', 'action' => 'myreservations']);
        
        // Rutas con parámetros - More specific ANTES de general
        // Usar wildcard para servicios para evitar conflictos con DashedRoute
        $builder->connect(
            '/services/*',
            ['controller' => 'Frontend', 'action' => 'service'],
            ['pass' => ['pass']]
        );
        $builder->connect('/services', ['controller' => 'Frontend', 'action' => 'services']);

        // Páginas estáticas (si las necesitas después)
        $builder->connect('/pages/*', 'Pages::display');

        // Rutas de roles
        $builder->connect('/panel/admin', ['controller' => 'Dashboard', 'action' => 'adminPanel']);
        $builder->connect('/panel/operador', ['controller' => 'Dashboard', 'action' => 'operadorPanel']);
        $builder->connect('/panel/chofer', ['controller' => 'Dashboard', 'action' => 'choferPanel']);

        //Ruta para crear las reservas
        $builder->connect('/reservations', ['controller' => 'XservReservas', 'action' => 'reservations']);


        // ==============================
        // XservServicios
        // ==============================
        $builder->connect(
            '/xserv-servicios.json',
            ['controller' => 'XservServicios', 'action' => 'index', '_ext' => 'json']
        );
        $builder->connect(
            '/xserv-servicios/view/:id.json',
            ['controller' => 'XservServicios', 'action' => 'view', '_ext' => 'json'],
            ['id' => '[0-9]+', 'pass' => ['id']]
        );
        $builder->connect(
            '/xserv-servicios/view/:id',
            ['controller' => 'XservServicios', 'action' => 'view'],
            ['id' => '[0-9]+', 'pass' => ['id']]
        );
        $builder->connect(
            '/xserv-servicios',
            ['controller' => 'XservServicios', 'action' => 'index']
        );

        // ==============================
        // XservReservas
        // ==============================
        $builder->connect(
            '/xserv-reservas/my-reservations',
            ['controller' => 'XservReservas', 'action' => 'myReservations']
        );
        $builder->connect(
            '/xserv-reservas/my-reservations.json',
            ['controller' => 'XservReservas', 'action' => 'myReservations', '_ext' => 'json']
        );

        // ==============================
        // XservUsuarios
        // ==============================
        $builder->connect(
            '/xserv-usuarios/profile',
            ['controller' => 'XservUsuarios', 'action' => 'profile']
        );
        $builder->connect(
            '/xserv-usuarios/me',
            ['controller' => 'XservUsuarios', 'action' => 'me']
        );
        $builder->connect(
            '/xserv-usuarios/me.json',
            ['controller' => 'XservUsuarios', 'action' => 'me', '_ext' => 'json']
        );

        $builder->connect('/', [
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
        
        // Fallbacks - necesario para rutas no explícitas
        $builder->fallbacks();
    });
};
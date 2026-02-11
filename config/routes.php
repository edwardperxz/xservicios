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
        $builder->connect('/home', ['controller' => 'Home', 'action' => 'index',]);
        $builder->connect('/home-login', ['controller' => 'Home', 'action' => 'home_login',]);
        $builder->connect('/fleet', ['controller' => 'Frontend', 'action' => 'fleet']);
        $builder->connect('/services', ['controller' => 'Frontend', 'action' => 'services']);
        $builder->connect('/about', ['controller' => 'Frontend', 'action' => 'about']);
        $builder->connect('/newreservation', ['controller' => 'Frontend', 'action' => 'newreservation']);
        $builder->connect('/myreservations', ['controller' => 'Frontend', 'action' => 'myreservations']);
        $builder->connect('/rateservice', ['controller' => 'Frontend', 'action' => 'rateservice']);
        $builder->connect('/signup', ['controller' => 'Frontend', 'action' => 'signup']);
        $builder->connect('/login', ['controller' => 'Frontend', 'action' => 'login']);

        // Páginas estáticas (si las necesitas después)
        $builder->connect('/pages/*', 'Pages::display');

        // Rutas de roles
        $builder->connect('/panel/admin', ['controller' => 'Dashboard', 'action' => 'adminPanel']);
        $builder->connect('/panel/operador', ['controller' => 'Dashboard', 'action' => 'operadorPanel']);
        $builder->connect('/panel/chofer', ['controller' => 'Dashboard', 'action' => 'choferPanel']);

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
        
        // Fallbacks (solo para desarrollo)
        $builder->fallbacks();
    });
};

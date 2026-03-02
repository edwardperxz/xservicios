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
        $builder->connect('/panel/chofer', ['controller' => 'Dashboard', 'action' => 'choferPanel']);
        $builder->connect('/requests', ['controller' => 'Dashboard', 'action' => 'requests']);
        $builder->connect('/notifications', ['controller' => 'Dashboard', 'action' => 'choferNotifications']);
        
        // Rutas de usuario
        $builder->connect('/settings', ['controller' => 'Profile', 'action' => 'settings']);
        $builder->connect('/profile', ['controller' => 'Profile', 'action' => 'index']);
        
        // Rutas específicas para chofer
        $builder->connect('/chofer', ['controller' => 'Dashboard', 'action' => 'choferViajes']);
        $builder->connect('/chofer/viajes', ['controller' => 'Dashboard', 'action' => 'choferViajes']);
        $builder->connect('/chofer/viajes/detalle/*', ['controller' => 'Dashboard', 'action' => 'choferViajeDetalle'], ['pass' => ['id']]);
        $builder->connect('/chofer/viajes/detalle/:id', ['controller' => 'Dashboard', 'action' => 'choferViajeDetalle'], ['id' => '[0-9]+', 'pass' => ['id']]);
        $builder->connect('/chofer/viajes/:id', ['controller' => 'XservChoferes', 'action' => 'viajesHistorial'], ['id' => '[0-9]+', 'pass' => ['id']]);
        
        // Panel de chofer - gestión de servicios
        $builder->connect('/xserv-ejecucion-viajes/chofer-panel', ['controller' => 'XservEjecucionViajes', 'action' => 'choferPanel']);
        $builder->connect('/xserv-ejecucion-viajes/iniciar-servicio', ['controller' => 'XservEjecucionViajes', 'action' => 'iniciarServicio']);
        $builder->connect('/xserv-ejecucion-viajes/finalizar-servicio', ['controller' => 'XservEjecucionViajes', 'action' => 'finalizarServicio']);
        
        // Gestión de incidencias para choferes
        $builder->connect('/xserv-incidencias-viaje/reportar-incidencia', ['controller' => 'XservIncidenciasViaje', 'action' => 'reportarIncidencia']);
        $builder->connect('/xserv-incidencias-viaje/resolver-incidencia', ['controller' => 'XservIncidenciasViaje', 'action' => 'resolverIncidencia']);
        
        // API Chofer - Asignaciones (DEBEN IR ANTES DE OTRAS RUTAS)
        $builder->scope('/chofer', function (RouteBuilder $routes) {
            $routes->connect('/asignacion/:id/aceptar', ['controller' => 'Dashboard', 'action' => 'aceptarAsignacion'], ['id' => '[0-9]+', 'pass' => ['id']]);
            $routes->connect('/asignacion/:id/rechazar', ['controller' => 'Dashboard', 'action' => 'rechazarAsignacion'], ['id' => '[0-9]+', 'pass' => ['id']]);
        });
        
        $builder->connect('/api/chofer/asignaciones', ['controller' => 'Dashboard', 'action' => 'getAsignaciones']);
        $builder->connect('/api/chofer/stats', ['controller' => 'Dashboard', 'action' => 'getChoferStats']);
        $builder->connect('/api/chofer/asignacion/update', ['controller' => 'Dashboard', 'action' => 'updateAsignacion']);

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
            '/xserv-reservas/reserva-rapida',
            ['controller' => 'XservReservas', 'action' => 'reservaRapida']
        );
        $builder->connect(
            '/xserv-reservas/quick-reserve',
            ['controller' => 'XservReservas', 'action' => 'quickReserve']
        );
        $builder->connect(
            '/xserv-reservas/quick-reserve.json',
            ['controller' => 'XservReservas', 'action' => 'quickReserve', '_ext' => 'json']
        );
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

        // ==============================
        // XservChoferes
        // ==============================
        $builder->connect(
            '/xserv-choferes/profile',
            ['controller' => 'XservChoferes', 'action' => 'profile']
        );
        $builder->connect(
            '/xserv-choferes/profile/:id',
            ['controller' => 'XservChoferes', 'action' => 'profile'],
            ['id' => '[0-9]+', 'pass' => ['id']]
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
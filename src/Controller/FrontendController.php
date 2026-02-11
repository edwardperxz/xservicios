<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Http\Response;

/**
 * Frontend Controller
 * Sirve archivos HTML estáticos del frontend
 */
class FrontendController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Permitir acceso sin autenticación para todas las acciones públicas
        $this->Authentication->addUnauthenticatedActions(['fleet', 'services', 'about', 'newreservation', 'myreservations', 'rateservice', 'signup', 'login']);
        // Saltar verificación de autorización para acciones públicas
        $this->Authorization->skipAuthorization(['fleet', 'services', 'about', 'newreservation', 'myreservations', 'rateservice', 'signup', 'login']);
    }

    /**
     * Fleet page (ver-flota.html)
     */
    public function fleet()
    {
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/ver-flota.html');
        $content = $this->injectCsrfToken($content);
        return $this->response->withStringBody($content);
    }

    /**
     * Services page (servicios.html)
     */
    public function services()
    {
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/servicios.html');
        $content = $this->injectCsrfToken($content);
        return $this->response->withStringBody($content);
    }

    /**
     * About page (Nosotros.html)
     */
    public function about()
    {
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/Nosotros.html');
        $content = $this->injectCsrfToken($content);
        return $this->response->withStringBody($content);
    }

    /**
     * New Reservation page (nueva-reserva.html)
     */
    public function newreservation()
    {
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/nueva-reserva.html');
        $content = $this->injectCsrfToken($content);
        return $this->response->withStringBody($content);
    }

    /**
     * My Reservations page (mis-reservas.html)
     */
    public function myreservations()
    {
        $this->response = $this->response->withType('text/html');
        $content = $this->injectCsrfToken($content);
        $content = file_get_contents(ROOT . '/webroot/frontend/mis-reservas.html');
        return $this->response->withStringBody($content);
    }

    /**
     * Rate Service page (valorar-servicios.html)
     */
    public function rateservice()
    {
        $this->response = $this->response->withType('text/html');
        $content = $this->injectCsrfToken($content);
        $content = file_get_contents(ROOT . '/webroot/frontend/valorar-servicios.html');
        return $this->response->withStringBody($content);
    }

    /**
     * Sign up page (crear-cuenta.html)
     */
    public function signup()
    {
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/crear-cuenta.html');
        $content = $this->injectCsrfToken($content);
        return $this->response->withStringBody($content);
    }

    /**
     * Login page (inicio-sesion.html)
     */
    public function login()
    {
        $content = $this->injectCsrfToken($content);
        return $this->response->withStringBody($content);
    }

    /**
     * Inyecta el CSRF token en el HTML
     */
    private function injectCsrfToken(string $html): string
    {
        $csrfToken = $this->request->getAttribute('csrfToken');
        $metaTag = '<meta name="csrfToken" content="' . htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') . '">';
        
        // Inyectar el meta tag antes del cierre de </head>
        return str_replace('</head>', $metaTag . "\n</head>", $html);
    }
}

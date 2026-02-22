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
     * Fleet page (fleet.html)
     */
    public function fleet()
    {
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/fleet.html');
        $content = $this->injectCsrfToken($content);
        return $this->response->withStringBody($content);
    }

    /**
     * Services page (services.html)
     */
    public function services()
    {
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/services.html');
        $content = $this->injectCsrfToken($content);
        return $this->response->withStringBody($content);
    }

    /**
     * About page (about.html)
     */
    public function about()
    {
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/about.html');
        $content = $this->injectCsrfToken($content);
        return $this->response->withStringBody($content);
    }

    /**
     * New Reservation page (new-reservation.html)
     */
    public function newreservation()
    {
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/new-reservation.html');
        $content = $this->injectCsrfToken($content);
        return $this->response->withStringBody($content);
    }

    /**
     * My Reservations page (my-reservations.html)
     */
    public function myreservations()
    {
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/my-reservations.html');
        $content = $this->injectCsrfToken($content);
        return $this->response->withStringBody($content);
    }

    /**
     * Rate Service page (rate-service.html)
     */
    public function rateservice()
    {
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/rate-service.html');
        $content = $this->injectCsrfToken($content);
        return $this->response->withStringBody($content);
    }

    /**
     * Sign up page (signup.html)
     */
    public function signup()
    {
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/signup.html');
        $content = $this->injectCsrfToken($content);
        return $this->response->withStringBody($content);
    }

    /**
     * Login page (login.html)
     */
    public function login()
    {
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/login.html');
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

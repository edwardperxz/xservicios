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
     * Fleet page (fleet.php)
     */
    public function fleet()
    {
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/user/fleet.php');
        $content = $this->injectCsrfToken($content);
        return $this->response->withStringBody($content);
    }

    /**
     * Services page (services.php)
     */
    public function services()
    {
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/shared/services.php');
        $content = $this->injectCsrfToken($content);
        return $this->response->withStringBody($content);
    }

    /**
     * About page (about.php)
     */
    public function about()
    {
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/shared/about.php');
        $content = $this->injectCsrfToken($content);
        return $this->response->withStringBody($content);
    }

    /**
     * New Reservation page (new-reservation.php)
     */
    public function newreservation()
    {
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/user/new-reservation.php');
        $content = $this->injectCsrfToken($content);
        return $this->response->withStringBody($content);
    }

    /**
     * My Reservations page (my-reservations.php)
     */
    public function myreservations()
    {
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/user/my-reservations.php');
        $content = $this->injectCsrfToken($content);
        return $this->response->withStringBody($content);
    }

    /**
     * Rate Service page (rate-service.php)
     */
    public function rateservice()
    {
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/user/rate-service.php');
        $content = $this->injectCsrfToken($content);
        return $this->response->withStringBody($content);
    }

    /**
     * Sign up page (signup.php)
     */
    public function signup()
    {
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/shared/signup.php');
        $content = $this->injectCsrfToken($content);
        return $this->response->withStringBody($content);
    }

    /**
     * Login page (login.php)
     */
    public function login()
    {
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/shared/login.php');
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

<?php
declare(strict_types=1);

namespace App\Controller;

use App\Utility\DemoData;
use Cake\Event\EventInterface;
use Cake\Http\Response;
use Cake\ORM\TableRegistry;

/**
 * Frontend Controller
 * Sirve archivos HTML del frontend con datos dinámicos
 */
class FrontendController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        // Cargar modelos necesarios
        $this->XservVehiculos = TableRegistry::getTableLocator()->get('XservVehiculos');
        $this->XservChoferes = TableRegistry::getTableLocator()->get('XservChoferes');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Permitir acceso sin autenticación para todas las acciones públicas
        $this->Authentication->addUnauthenticatedActions(['fleet', 'services', 'service', 'about', 'newreservation', 'rateservice', 'signup', 'login', 'myreservations']);
        // Saltar verificación de autorización para acciones públicas
        $this->Authorization->skipAuthorization(['fleet', 'services', 'service', 'about', 'newreservation', 'rateservice', 'signup', 'login', 'myreservations']);
    }

    /**
     * Fleet page - Carga datos reales de vehículos y choferes
     */
    public function fleet()
    {
        if (DemoData::isEnabled()) {
            $vehiculos = DemoData::fleetVehicles();
            $choferes = DemoData::fleetDrivers();
            $choferesRatings = DemoData::fleetRatings();
        } else {
            // Cargar datos reales de la BD
            $vehiculos = $this->XservVehiculos->find()->toArray();
            $choferes = $this->XservChoferes->find()->contain('Usuarios')->toArray();

            // Obtener promedio de valoraciones para cada chofer
            $choferesRatings = [];
            $asignacionesTable = TableRegistry::getTableLocator()->get('XservAsignaciones');
            $valoracionesTable = TableRegistry::getTableLocator()->get('XservValoraciones');

            foreach ($choferes as $chofer) {
                // Obtener todas las asignaciones del chofer
                $asignaciones = $asignacionesTable->find()
                    ->where(['chofer_id' => $chofer->id])
                    ->select(['reserva_id'])
                    ->toArray();
                
                $reservaIds = array_column($asignaciones, 'reserva_id');
                
                $promedioCalificacion = 0;
                $totalValoraciones = 0;
                
                if (!empty($reservaIds)) {
                    $valoraciones = $valoracionesTable->find()
                        ->where(['reserva_id IN' => $reservaIds, 'calificacion >' => 0])
                        ->select(['calificacion'])
                        ->toArray();
                    
                    if (!empty($valoraciones)) {
                        $totalCalificacion = 0;
                        foreach ($valoraciones as $val) {
                            $totalCalificacion += $val->calificacion;
                        }
                        $totalValoraciones = count($valoraciones);
                        $promedioCalificacion = round($totalCalificacion / $totalValoraciones, 1);
                    }
                }
                
                $choferesRatings[$chofer->id] = [
                    'promedio' => $promedioCalificacion,
                    'total' => $totalValoraciones
                ];
            }
        }

        // Renderizar con datos
        ob_start();
        include ROOT . '/webroot/frontend/user/fleet.php';
        $content = ob_get_clean();
        
        $this->response = $this->response->withType('text/html');
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
     * Service detail page (service-detail.php)
     */
    public function service(...$pass)
    {
        // Extraer el ID del primer elemento del array de parámetros
        $id = $pass[0] ?? null;
        
        if (!$id) {
            return $this->redirect('/services');
        }
        
        $this->response = $this->response->withType('text/html');
        $content = file_get_contents(ROOT . '/webroot/frontend/shared/service-detail.php');
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
        $demoScript = DemoData::isEnabled() ? '<script src="/js/demo-mode.js"></script>' : '';
        
        // Inyectar el meta tag antes del cierre de </head>
        return str_replace('</head>', $metaTag . "\n" . $demoScript . "\n</head>", $html);
    }
}

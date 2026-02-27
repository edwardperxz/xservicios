<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;

use Cake\ORM\TableRegistry;


class HomeController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');
        $this->loadComponent('Authorization.Authorization');
        
        // Cargar modelos
        $this->XservVehiculos = TableRegistry::getTableLocator()->get('XservVehiculos');
        $this->XservChoferes = TableRegistry::getTableLocator()->get('XservChoferes');
    }

    public function beforeFilter(EventInterface $event): void
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['index']);
    }

    public function index()
    {
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');


        // Si hay sesión, redirigir por rol
        if ($user) {
            $rol = $user->rol ?? null;

            if ($rol === 'admin') {
                return $this->redirect('/panel/admin');
            }

            if ($rol === 'chofer') {
                return $this->redirect('/panel/chofer');
            }

            // Usuario autenticado (operador u otro)
            $this->set('isAuthenticated', true);
            $this->set('user', $user);

            if ($rol === 'operador') {
                $reservasTable = TableRegistry::getTableLocator()->get('XservReservas');
                $misReservas = $reservasTable->find()
                ->contain(['Servicios', 'Clientes'])
                ->where([
                    'Clientes.usuario_id' => $user->id
                ])
                ->order([
                    'XservReservas.fecha' => 'DESC',
                    'XservReservas.hora' => 'DESC'
                ])
                ->all();
                $this->set('misReservas', $misReservas);
            }
        } else {
            // Usuario no autenticado
            $this->set('isAuthenticated', false);
        }

        // Cargar datos reales de vehículos y choferes
        $vehiculos = $this->XservVehiculos->find()->where(['estado_operativo' => 'disponible'])->limit(4)->toArray();
        $choferes = $this->XservChoferes->find()->contain('Usuarios')->where(['XservChoferes.estado' => 'activo'])->limit(6)->toArray();

        $this->set(compact('vehiculos', 'choferes'));
        
        // Renderiza el archivo unificado index.php sin layout
        $this->viewBuilder()->disableAutoLayout();
    }
}

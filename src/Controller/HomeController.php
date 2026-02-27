<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

use Cake\ORM\TableRegistry;


class HomeController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');
        $this->loadComponent('Authorization.Authorization');
        
        // Use clean frontend layout without CakePHP UI
        $this->viewBuilder()->setLayout('frontend');
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
        
        // Renderiza el archivo unificado index.php sin layout
        $this->viewBuilder()->disableAutoLayout();
    }
}

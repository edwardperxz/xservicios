<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

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

            if ($rol === 'operador') {
                $this->set('isAuthenticated', true);
                $this->set('user', $user);
                return $this->render('/Home/home_login');
            }

            if ($rol === 'chofer') {
                return $this->redirect('/panel/chofer');
            }

            // Usuario autenticado sin rol de panel
            $this->set('isAuthenticated', true);
            $this->set('user', $user);
            return $this->render('/Home/home_login');
        }

        // Usuario no autenticado - mostrar home-public
        $this->set('isAuthenticated', false);
        return $this->render('/Home/home_public');
    }

    public function home_login()
    {
        $this->viewBuilder()->setLayout('home_login');
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');

        if (!$user) {
            return $this->redirect(['action' => 'index']);
        }

        // Buscar cliente asociado
        $this->loadModel('XservReservas');

        $cliente = $this->XservReservas->Clientes
            ->find()
            ->where(['usuario_id' => $user->id])
            ->first();

        $reservas = [];

        if ($cliente) {
            $reservas = $this->XservReservas
                ->find()
                ->where(['cliente_id' => $cliente->id])
                ->contain(['Servicios', 'Rutas'])
                ->orderDesc('created')
                ->all();
        }

        $this->set(compact('user', 'reservas'));
}

}

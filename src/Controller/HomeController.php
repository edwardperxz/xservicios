<?php
declare(strict_types=1);

namespace App\Controller;

class HomeController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');
        $this->loadComponent('Authorization.Authorization');
    }

    public function index()
    {
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');
        $this->viewBuilder()->setLayout('xservicios');

        // Si hay sesión, luego podrás redirigir por rol
        if ($user) {
            $rol = $user->rol;

            // (opcional por ahora, lo dejamos preparado)
            // switch ($rol) {
            //     case 'admin':
            //         return $this->redirect(['controller' => 'Dashboard', 'action' => 'admin']);
            //     case 'operador':
            //         return $this->redirect(['controller' => 'Dashboard', 'action' => 'operador']);
            //     case 'chofer':
            //         return $this->redirect(['controller' => 'Dashboard', 'action' => 'chofer']);
            // }
        }

        // Usuario NO logueado → home público (root)
        $this->render('/Pages/home');
    }
}

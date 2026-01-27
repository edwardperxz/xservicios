<?php
declare(strict_types=1);

namespace App\Controller;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        // Permitir acceder al login sin estar autenticado
        $this->Authentication->allowUnauthenticated(['login']);
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        // Si el usuario ya está logueado
        if ($result && $result->isValid()) {
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Pages',
                'action' => 'display',
                'home',
            ]);

            return $this->redirect($redirect);
        }

        // Si es POST y falló
        if ($this->request->is('post') && (!$result || !$result->isValid())) {
            $this->Flash->error('Usuario o contraseña incorrectos');
        }
    }

    public function logout()
    {
        $this->request->allowMethod(['post', 'get']);
        $this->Authentication->logout();

        return $this->redirect(['action' => 'login']);
    }
}

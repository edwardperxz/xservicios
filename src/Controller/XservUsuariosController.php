<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

class XservUsuariosController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        // Permitir acceso sin autenticación
        $this->Authentication->addUnauthenticatedActions(['login']);
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);

        $result = $this->Authentication->getResult();

        // Si ya está logueado → fuera
        if ($result->isValid()) {
            return $this->redirect('/');
        }

        // Si POST y falló
        if ($this->request->is('post') && !$result->isValid()) {
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

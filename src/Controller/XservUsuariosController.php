<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

class XservUsuariosController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        //login NO requiere autenticación
        $this->Authentication->addUnauthenticatedActions(['login']);
    }

    public function login()
    {
        //login NO requiere autorización
        $this->Authorization->skipAuthorization();

        $result = $this->Authentication->getResult();

        if ($result->isValid()) {
            return $this->redirect('/');
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Usuario o contraseña incorrectos');
        }
    }

    public function logout()
    {
        $this->Authorization->skipAuthorization();

        $this->Authentication->logout();

        return $this->redirect(['action' => 'login']);
    }
}


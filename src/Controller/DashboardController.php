<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

class DashboardController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');
        $this->loadComponent('Authorization.Authorization');
        $this->viewBuilder()->setLayout('frontend');
    }

    public function beforeFilter(EventInterface $event): void
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions([]);
    }

    public function adminPanel()
    {
        $user = $this->request->getAttribute('identity');
        $this->Authorization->skipAuthorization();

        if (!$user || $user->rol !== 'admin') {
            return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'profile']);
        }

        $this->set(compact('user'));

        // Usa la vista de profile
        $this->render('/XservUsuarios/profile');
    }


    public function operadorPanel()
    {
        $user = $this->request->getAttribute('identity');
        $this->Authorization->skipAuthorization();

        if (!$user || $user->rol !== 'operador') {
            return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'profile']);
        }

        $this->set(compact('user'));

        $this->render('/XservUsuarios/profile');
    }


    public function choferPanel()
    {
        $user = $this->request->getAttribute('identity');
        $this->Authorization->skipAuthorization();

        if (!$user || $user->rol !== 'chofer') {
            return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'profile']);
        }

        $choferesTable = $this->fetchTable('XservChoferes');

        $chofer = $choferesTable
            ->find()
            ->where(['usuario_id' => $user->id])
            ->first();

        $this->set(compact('user', 'chofer'));

        $this->render('/XservUsuarios/profile');
    }

}

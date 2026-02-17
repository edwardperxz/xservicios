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
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');
        if (!$user) {
            return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'login']);
        }

        $this->set('isAuthenticated', true);
        $this->set('user', $user);
        return $this->render('/Home/home_login');
    }

    public function choferPanel()
    {
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');
        if (!$user) {
            return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'login']);
        }

        $this->set('user', $user);
        return $this->render('/Dashboard/chofer_panel');
    }
}

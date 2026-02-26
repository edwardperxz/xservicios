<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservChoferes Controller
 *
 * @property \App\Model\Table\XservChoferesTable $XservChoferes
 */
class XservChoferesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authorization->skipAuthorization();
        
        // Usar layout admin si el usuario es admin
        $user = $this->Authentication->getIdentity();
        if ($user && $user->rol === 'admin') {
            $this->viewBuilder()->setLayout('admin');
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        
        $user = $this->Authentication->getIdentity();
        $isAdmin = $user && $user->rol === 'admin';
        
        $query = $this->XservChoferes->find()
            ->contain(['Usuarios']);
        
        $filters = $this->request->getQuery();
        
        if (!empty($filters['disponibilidad'])) {
            $query->where(['disponibilidad' => $filters['disponibilidad']]);
        }
        
        if (!empty($filters['estado'])) {
            $query->where(['estado' => $filters['estado']]);
        }
        
        if (!empty($filters['nombre'])) {
            $query->where(['nombre LIKE' => '%' . $filters['nombre'] . '%']);
        }
        
        $xservChoferes = $this->paginate($query);
        
        $this->set(compact('xservChoferes', 'filters'));
        
        if ($isAdmin) {
            $this->render('admin_index');
        }
    }

    /**
     * Admin index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function adminIndex()
    {
        $this->Authorization->skipAuthorization();

        $user = $this->Authentication->getIdentity();
        if (!$user || $user->rol !== 'admin') {
            return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'profile']);
        }

        $this->viewBuilder()->setLayout('admin');

        $query = $this->XservChoferes->find()
            ->contain(['Usuarios']);

        $filters = $this->request->getQuery();

        if (!empty($filters['disponibilidad'])) {
            $query->where(['disponibilidad' => $filters['disponibilidad']]);
        }

        if (!empty($filters['estado'])) {
            $query->where(['estado' => $filters['estado']]);
        }

        if (!empty($filters['nombre'])) {
            $query->where(['nombre LIKE' => '%' . $filters['nombre'] . '%']);
        }

        $xservChoferes = $this->paginate($query);

        $this->set(compact('xservChoferes', 'filters'));
        $this->render('admin_index');
    }

    public function chofers()
    {
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('chofers');

        // Obtener todos los choferes con Usuarios
        $query = $this->XservChoferes->find()->contain(['Usuarios'])->order(['nombre' => 'ASC']);

        // Paginar
        $xservChoferes = $this->paginate($query);
        $this->set(compact('xservChoferes'));
    }






    /**
     * View method
     *
    * @param string|null $id Xserv Chofer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $this->Authorization->skipAuthorization();
        $xservChofere = $this->XservChoferes->get($id, contain: ['Usuarios']);
        $this->set(compact('xservChofere'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();
        $xservChofere = $this->XservChoferes->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservChofere = $this->XservChoferes->patchEntity($xservChofere, $this->request->getData());
            if ($this->XservChoferes->save($xservChofere)) {
                $this->Flash->success(__('The xserv chofer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv chofer could not be saved. Please, try again.'));
        }
        $usuarios = $this->XservChoferes->Usuarios->find('list', limit: 200)->all();
        $this->set(compact('xservChofere', 'usuarios'));
    }

    /**
     * Edit method
     *
    * @param string|null $id Xserv Chofer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $this->Authorization->skipAuthorization();
        $xservChofere = $this->XservChoferes->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservChofere = $this->XservChoferes->patchEntity($xservChofere, $this->request->getData());
            if ($this->XservChoferes->save($xservChofere)) {
                $this->Flash->success(__('The xserv chofer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv chofer could not be saved. Please, try again.'));
        }
        $usuarios = $this->XservChoferes->Usuarios->find('list', limit: 200)->all();
        $this->set(compact('xservChofere', 'usuarios'));
    }

    /**
     * Delete method
     *
    * @param string|null $id Xserv Chofer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'delete']);
        $xservChofere = $this->XservChoferes->get($id);
        if ($this->XservChoferes->delete($xservChofere)) {
            $this->Flash->success(__('The xserv chofer has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv chofer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservServicios Controller
 *
 * @property \App\Model\Table\XservServiciosTable $XservServicios
 */
class XservServiciosController extends AppController
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

        $query = $this->XservServicios->find();
        
        $filters = $this->request->getQuery();
        
        if (!empty($filters['estado'])) {
            $query->where(['estado' => $filters['estado']]);
        }
        
        if (!empty($filters['nombre'])) {
            $query->where(['nombre LIKE' => '%' . $filters['nombre'] . '%']);
        }
        
        $xservServicios = $this->paginate($query);

        if ($this->request->is('json') || $this->request->getHeader('X-Requested-With') === 'XMLHttpRequest') {
            $this->response = $this->response->withType('application/json');
            return $this->response->withStringBody(json_encode([
                'xservServicios' => $xservServicios->toArray(),
            ]));
        }

        $this->set(compact('xservServicios', 'filters'));
        
        if ($isAdmin) {
            $this->render('admin_index');
        }
    }

    /**
     * View method
     *
     * @param string|null $id Xserv Servicio id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $this->Authorization->skipAuthorization();

        $xservServicio = $this->XservServicios->get($id, contain: []);
        $this->set(compact('xservServicio'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $xservServicio = $this->XservServicios->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservServicio = $this->XservServicios->patchEntity($xservServicio, $this->request->getData());
            if ($this->XservServicios->save($xservServicio)) {
                $this->Flash->success(__('The xserv servicio has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv servicio could not be saved. Please, try again.'));
        }
        $this->set(compact('xservServicio'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xserv Servicio id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $xservServicio = $this->XservServicios->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservServicio = $this->XservServicios->patchEntity($xservServicio, $this->request->getData());
            if ($this->XservServicios->save($xservServicio)) {
                $this->Flash->success(__('The xserv servicio has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv servicio could not be saved. Please, try again.'));
        }
        $this->set(compact('xservServicio'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xserv Servicio id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $xservServicio = $this->XservServicios->get($id);
        if ($this->XservServicios->delete($xservServicio)) {
            $this->Flash->success(__('The xserv servicio has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv servicio could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

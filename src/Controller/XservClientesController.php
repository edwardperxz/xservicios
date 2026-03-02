<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservClientes Controller
 *
 * @property \App\Model\Table\XservClientesTable $XservClientes
 */
class XservClientesController extends AppController
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
        $user = $this->Authentication->getIdentity();
        $isAdmin = $user && $user->rol === 'admin';
        $filters = $this->request->getQuery();

        $query = $this->XservClientes->find()
            ->contain(['XservUsuarios']);

        if (!empty($filters['identificacion_fiscal'])) {
            $query->where(['XservClientes.identificacion_fiscal LIKE' => '%' . $filters['identificacion_fiscal'] . '%']);
        }

        if (!empty($filters['idioma_preferido'])) {
            $query->where(['XservClientes.idioma_preferido' => $filters['idioma_preferido']]);
        }

        $xservClientes = $this->paginate($query);

        // Obtener valores distinctos para filtros
        $idiomas = $this->XservClientes->find()
            ->select(['idioma_preferido'])
            ->distinct(['idioma_preferido'])
            ->where(['idioma_preferido IS NOT' => null])
            ->order(['idioma_preferido' => 'ASC'])
            ->all()
            ->extract('idioma_preferido')
            ->toList();

        $this->set(compact('xservClientes', 'filters', 'idiomas'));

        if ($isAdmin) {
            $this->render('admin_index');
        }
    }

    /**
     * View method
     *
     * @param string|null $id Xserv Cliente id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $xservCliente = $this->XservClientes->get($id, contain: ['XservUsuarios']);
        $this->set(compact('xservCliente'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $xservCliente = $this->XservClientes->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservCliente = $this->XservClientes->patchEntity($xservCliente, $this->request->getData());
            if ($this->XservClientes->save($xservCliente)) {
                $this->Flash->success(__('The xserv cliente has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv cliente could not be saved. Please, try again.'));
        }
        $usuarios = $this->XservClientes->XservUsuarios->find('list', [
            'keyField' => 'id',
            'valueField' => function($usuario) {
                return $usuario->username . ' - ' . $usuario->nombre;
            }
        ])
        ->where(['rol' => 'operador'])
        ->orderBy(['username' => 'ASC']);
        $this->set(compact('xservCliente', 'usuarios'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xserv Cliente id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $xservCliente = $this->XservClientes->get($id, contain: ['XservUsuarios']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservCliente = $this->XservClientes->patchEntity($xservCliente, $this->request->getData());
            if ($this->XservClientes->save($xservCliente)) {
                $this->Flash->success(__('The xserv cliente has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv cliente could not be saved. Please, try again.'));
        }
        $usuarios = $this->XservClientes->XservUsuarios->find('list', [
            'keyField' => 'id',
            'valueField' => function($usuario) {
                return $usuario->username . ' - ' . $usuario->nombre;
            }
        ])
        ->where(['rol' => 'operador'])
        ->orderBy(['username' => 'ASC']);
        $this->set(compact('xservCliente', 'usuarios'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xserv Cliente id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $xservCliente = $this->XservClientes->get($id);
        if ($this->XservClientes->delete($xservCliente)) {
            $this->Flash->success(__('The xserv cliente has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv cliente could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

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
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->XservClientes->find();
        $xservClientes = $this->paginate($query);

        $this->set(compact('xservClientes'));
    }

    /**
     * View method
     *
     * @param string|null $id Xserv Cliente id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $xservCliente = $this->XservClientes->get($id, contain: []);
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
        $this->set(compact('xservCliente'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xserv Cliente id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $xservCliente = $this->XservClientes->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservCliente = $this->XservClientes->patchEntity($xservCliente, $this->request->getData());
            if ($this->XservClientes->save($xservCliente)) {
                $this->Flash->success(__('The xserv cliente has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv cliente could not be saved. Please, try again.'));
        }
        $this->set(compact('xservCliente'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xserv Cliente id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
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

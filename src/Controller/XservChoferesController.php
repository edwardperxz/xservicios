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
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->XservChoferes->find()
            ->contain(['Usuarios']);
        $xservChoferes = $this->paginate($query);

        $this->set(compact('xservChoferes'));
    }

    /**
     * View method
     *
     * @param string|null $id Xserv Chofere id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
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
        $xservChofere = $this->XservChoferes->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservChofere = $this->XservChoferes->patchEntity($xservChofere, $this->request->getData());
            if ($this->XservChoferes->save($xservChofere)) {
                $this->Flash->success(__('The xserv chofere has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv chofere could not be saved. Please, try again.'));
        }
        $usuarios = $this->XservChoferes->Usuarios->find('list', limit: 200)->all();
        $this->set(compact('xservChofere', 'usuarios'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xserv Chofere id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $xservChofere = $this->XservChoferes->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservChofere = $this->XservChoferes->patchEntity($xservChofere, $this->request->getData());
            if ($this->XservChoferes->save($xservChofere)) {
                $this->Flash->success(__('The xserv chofere has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv chofere could not be saved. Please, try again.'));
        }
        $usuarios = $this->XservChoferes->Usuarios->find('list', limit: 200)->all();
        $this->set(compact('xservChofere', 'usuarios'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xserv Chofere id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $xservChofere = $this->XservChoferes->get($id);
        if ($this->XservChoferes->delete($xservChofere)) {
            $this->Flash->success(__('The xserv chofere has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv chofere could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

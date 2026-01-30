<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservValoraciones Controller
 *
 * @property \App\Model\Table\XservValoracionesTable $XservValoraciones
 */
class XservValoracionesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->XservValoraciones->find()
            ->contain(['XservReservas']);
        $xservValoraciones = $this->paginate($query);

        $this->set(compact('xservValoraciones'));
    }

    /**
     * View method
     *
     * @param string|null $id Xserv Valoracione id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $xservValoracione = $this->XservValoraciones->get($id, contain: ['XservReservas']);
        $this->set(compact('xservValoracione'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $xservValoracione = $this->XservValoraciones->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservValoracione = $this->XservValoraciones->patchEntity($xservValoracione, $this->request->getData());
            if ($this->XservValoraciones->save($xservValoracione)) {
                $this->Flash->success(__('The xserv valoracione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv valoracione could not be saved. Please, try again.'));
        }
        $xservReservas = $this->XservValoraciones->XservReservas->find('list', limit: 200)->all();
        $this->set(compact('xservValoracione', 'xservReservas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xserv Valoracione id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $xservValoracione = $this->XservValoraciones->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservValoracione = $this->XservValoraciones->patchEntity($xservValoracione, $this->request->getData());
            if ($this->XservValoraciones->save($xservValoracione)) {
                $this->Flash->success(__('The xserv valoracione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv valoracione could not be saved. Please, try again.'));
        }
        $xservReservas = $this->XservValoraciones->XservReservas->find('list', limit: 200)->all();
        $this->set(compact('xservValoracione', 'xservReservas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xserv Valoracione id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $xservValoracione = $this->XservValoraciones->get($id);
        if ($this->XservValoraciones->delete($xservValoracione)) {
            $this->Flash->success(__('The xserv valoracione has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv valoracione could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

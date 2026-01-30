<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservEjecucionViajes Controller
 *
 * @property \App\Model\Table\XservEjecucionViajesTable $XservEjecucionViajes
 */
class XservEjecucionViajesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->XservEjecucionViajes->find()
            ->contain(['Asignacions']);
        $xservEjecucionViajes = $this->paginate($query);

        $this->set(compact('xservEjecucionViajes'));
    }

    /**
     * View method
     *
     * @param string|null $id Xserv Ejecucion Viaje id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $xservEjecucionViaje = $this->XservEjecucionViajes->get($id, contain: ['Asignacions']);
        $this->set(compact('xservEjecucionViaje'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $xservEjecucionViaje = $this->XservEjecucionViajes->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservEjecucionViaje = $this->XservEjecucionViajes->patchEntity($xservEjecucionViaje, $this->request->getData());
            if ($this->XservEjecucionViajes->save($xservEjecucionViaje)) {
                $this->Flash->success(__('The xserv ejecucion viaje has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv ejecucion viaje could not be saved. Please, try again.'));
        }
        $asignacions = $this->XservEjecucionViajes->Asignacions->find('list', limit: 200)->all();
        $this->set(compact('xservEjecucionViaje', 'asignacions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xserv Ejecucion Viaje id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $xservEjecucionViaje = $this->XservEjecucionViajes->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservEjecucionViaje = $this->XservEjecucionViajes->patchEntity($xservEjecucionViaje, $this->request->getData());
            if ($this->XservEjecucionViajes->save($xservEjecucionViaje)) {
                $this->Flash->success(__('The xserv ejecucion viaje has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv ejecucion viaje could not be saved. Please, try again.'));
        }
        $asignacions = $this->XservEjecucionViajes->Asignacions->find('list', limit: 200)->all();
        $this->set(compact('xservEjecucionViaje', 'asignacions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xserv Ejecucion Viaje id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $xservEjecucionViaje = $this->XservEjecucionViajes->get($id);
        if ($this->XservEjecucionViajes->delete($xservEjecucionViaje)) {
            $this->Flash->success(__('The xserv ejecucion viaje has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv ejecucion viaje could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

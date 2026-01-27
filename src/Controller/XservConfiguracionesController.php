<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservConfiguraciones Controller
 *
 * @property \App\Model\Table\XservConfiguracionesTable $XservConfiguraciones
 */
class XservConfiguracionesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->XservConfiguraciones->find();
        $xservConfiguraciones = $this->paginate($query);

        $this->set(compact('xservConfiguraciones'));
    }

    /**
     * View method
     *
     * @param string|null $id Xserv Configuracione id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $xservConfiguracione = $this->XservConfiguraciones->get($id, contain: []);
        $this->set(compact('xservConfiguracione'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $xservConfiguracione = $this->XservConfiguraciones->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservConfiguracione = $this->XservConfiguraciones->patchEntity($xservConfiguracione, $this->request->getData());
            if ($this->XservConfiguraciones->save($xservConfiguracione)) {
                $this->Flash->success(__('The xserv configuracione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv configuracione could not be saved. Please, try again.'));
        }
        $this->set(compact('xservConfiguracione'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xserv Configuracione id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $xservConfiguracione = $this->XservConfiguraciones->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservConfiguracione = $this->XservConfiguraciones->patchEntity($xservConfiguracione, $this->request->getData());
            if ($this->XservConfiguraciones->save($xservConfiguracione)) {
                $this->Flash->success(__('The xserv configuracione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv configuracione could not be saved. Please, try again.'));
        }
        $this->set(compact('xservConfiguracione'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xserv Configuracione id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $xservConfiguracione = $this->XservConfiguraciones->get($id);
        if ($this->XservConfiguraciones->delete($xservConfiguracione)) {
            $this->Flash->success(__('The xserv configuracione has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv configuracione could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservUbicaciones Controller
 *
 * @property \App\Model\Table\XservUbicacionesTable $XservUbicaciones
 */
class XservUbicacionesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->XservUbicaciones->find();
        $xservUbicaciones = $this->paginate($query);

        $this->set(compact('xservUbicaciones'));
    }

    /**
     * View method
     *
     * @param string|null $id Xserv Ubicacione id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $xservUbicacione = $this->XservUbicaciones->get($id, contain: []);
        $this->set(compact('xservUbicacione'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $xservUbicacione = $this->XservUbicaciones->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservUbicacione = $this->XservUbicaciones->patchEntity($xservUbicacione, $this->request->getData());
            if ($this->XservUbicaciones->save($xservUbicacione)) {
                $this->Flash->success(__('The xserv ubicacione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv ubicacione could not be saved. Please, try again.'));
        }
        $this->set(compact('xservUbicacione'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xserv Ubicacione id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $xservUbicacione = $this->XservUbicaciones->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservUbicacione = $this->XservUbicaciones->patchEntity($xservUbicacione, $this->request->getData());
            if ($this->XservUbicaciones->save($xservUbicacione)) {
                $this->Flash->success(__('The xserv ubicacione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv ubicacione could not be saved. Please, try again.'));
        }
        $this->set(compact('xservUbicacione'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xserv Ubicacione id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $xservUbicacione = $this->XservUbicaciones->get($id);
        if ($this->XservUbicaciones->delete($xservUbicacione)) {
            $this->Flash->success(__('The xserv ubicacione has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv ubicacione could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

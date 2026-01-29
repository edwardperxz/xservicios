<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservDestinos Controller
 *
 * @property \App\Model\Table\XservDestinosTable $XservDestinos
 */
class XservDestinosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->XservDestinos->find()
            ->contain(['Ubicacions']);
        $xservDestinos = $this->paginate($query);

        $this->set(compact('xservDestinos'));
    }

    /**
     * View method
     *
     * @param string|null $id Xserv Destino id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $xservDestino = $this->XservDestinos->get($id, contain: ['Ubicacions']);
        $this->set(compact('xservDestino'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $xservDestino = $this->XservDestinos->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservDestino = $this->XservDestinos->patchEntity($xservDestino, $this->request->getData());
            if ($this->XservDestinos->save($xservDestino)) {
                $this->Flash->success(__('The xserv destino has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv destino could not be saved. Please, try again.'));
        }
        $ubicacions = $this->XservDestinos->Ubicacions->find('list', limit: 200)->all();
        $this->set(compact('xservDestino', 'ubicacions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xserv Destino id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $xservDestino = $this->XservDestinos->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservDestino = $this->XservDestinos->patchEntity($xservDestino, $this->request->getData());
            if ($this->XservDestinos->save($xservDestino)) {
                $this->Flash->success(__('The xserv destino has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv destino could not be saved. Please, try again.'));
        }
        $ubicacions = $this->XservDestinos->Ubicacions->find('list', limit: 200)->all();
        $this->set(compact('xservDestino', 'ubicacions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xserv Destino id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $xservDestino = $this->XservDestinos->get($id);
        if ($this->XservDestinos->delete($xservDestino)) {
            $this->Flash->success(__('The xserv destino has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv destino could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

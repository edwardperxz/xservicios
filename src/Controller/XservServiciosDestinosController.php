<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservServiciosDestinos Controller
 *
 * @property \App\Model\Table\XservServiciosDestinosTable $XservServiciosDestinos
 */
class XservServiciosDestinosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->XservServiciosDestinos->find()
            ->contain(['Servicios', 'Destinos']);
        $xservServiciosDestinos = $this->paginate($query);

        $this->set(compact('xservServiciosDestinos'));
    }

    /**
     * View method
     *
     * @param string|null $id Xserv Servicios Destino id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $xservServiciosDestino = $this->XservServiciosDestinos->get($id, contain: ['Servicios', 'Destinos']);
        $this->set(compact('xservServiciosDestino'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $xservServiciosDestino = $this->XservServiciosDestinos->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservServiciosDestino = $this->XservServiciosDestinos->patchEntity($xservServiciosDestino, $this->request->getData());
            if ($this->XservServiciosDestinos->save($xservServiciosDestino)) {
                $this->Flash->success(__('The xserv servicios destino has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv servicios destino could not be saved. Please, try again.'));
        }
        $servicios = $this->XservServiciosDestinos->Servicios->find('list', limit: 200)->all();
        $destinos = $this->XservServiciosDestinos->Destinos->find('list', limit: 200)->all();
        $this->set(compact('xservServiciosDestino', 'servicios', 'destinos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xserv Servicios Destino id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $xservServiciosDestino = $this->XservServiciosDestinos->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservServiciosDestino = $this->XservServiciosDestinos->patchEntity($xservServiciosDestino, $this->request->getData());
            if ($this->XservServiciosDestinos->save($xservServiciosDestino)) {
                $this->Flash->success(__('The xserv servicios destino has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv servicios destino could not be saved. Please, try again.'));
        }
        $servicios = $this->XservServiciosDestinos->Servicios->find('list', limit: 200)->all();
        $destinos = $this->XservServiciosDestinos->Destinos->find('list', limit: 200)->all();
        $this->set(compact('xservServiciosDestino', 'servicios', 'destinos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xserv Servicios Destino id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $xservServiciosDestino = $this->XservServiciosDestinos->get($id);
        if ($this->XservServiciosDestinos->delete($xservServiciosDestino)) {
            $this->Flash->success(__('The xserv servicios destino has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv servicios destino could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

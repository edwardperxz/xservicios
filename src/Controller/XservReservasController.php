<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservReservas Controller
 *
 * @property \App\Model\Table\XservReservasTable $XservReservas
 */
class XservReservasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        
        $query = $this->XservReservas->find()
            ->contain(['Clientes', 'Servicios', 'Rutas']);
        $xservReservas = $this->paginate($query);

        $this->set(compact('xservReservas'));
    }

    /**
     * View method
     *
     * @param string|null $id Xserv Reserva id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $this->Authorization->skipAuthorization();
        
        $xservReserva = $this->XservReservas->get($id, contain: ['Clientes', 'Servicios', 'Rutas']);
        $this->set(compact('xservReserva'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();
        
        $xservReserva = $this->XservReservas->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservReserva = $this->XservReservas->patchEntity($xservReserva, $this->request->getData());
            if ($this->XservReservas->save($xservReserva)) {
                $this->Flash->success(__('The xserv reserva has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv reserva could not be saved. Please, try again.'));
        }
        $clientes = $this->XservReservas->Clientes->find('list', limit: 200)->all();
        $servicios = $this->XservReservas->Servicios->find('list', limit: 200)->all();
        $rutas = $this->XservReservas->Rutas->find('list', limit: 200)->all();
        $this->set(compact('xservReserva', 'clientes', 'servicios', 'rutas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xserv Reserva id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $this->Authorization->skipAuthorization();
        
        $xservReserva = $this->XservReservas->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservReserva = $this->XservReservas->patchEntity($xservReserva, $this->request->getData());
            if ($this->XservReservas->save($xservReserva)) {
                $this->Flash->success(__('The xserv reserva has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv reserva could not be saved. Please, try again.'));
        }
        $clientes = $this->XservReservas->Clientes->find('list', limit: 200)->all();
        $servicios = $this->XservReservas->Servicios->find('list', limit: 200)->all();
        $rutas = $this->XservReservas->Rutas->find('list', limit: 200)->all();
        $this->set(compact('xservReserva', 'clientes', 'servicios', 'rutas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xserv Reserva id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->Authorization->skipAuthorization();
        
        $this->request->allowMethod(['post', 'delete']);
        $xservReserva = $this->XservReservas->get($id);
        if ($this->XservReservas->delete($xservReserva)) {
            $this->Flash->success(__('The xserv reserva has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv reserva could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

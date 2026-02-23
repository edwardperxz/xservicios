<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservNotificaciones Controller
 *
 * @property \App\Model\Table\XservNotificacionesTable $XservNotificaciones
 */
class XservNotificacionesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->XservNotificaciones->find()
            ->contain(['Usuarios', 'Clientes', 'Reservas']);
        $xservNotificaciones = $this->paginate($query);

        $this->set(compact('xservNotificaciones'));
    }

    /**
     * View method
     *
     * @param string|null $id Xserv Notificacione id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $xservNotificacione = $this->XservNotificaciones->get($id, contain: ['Usuarios', 'Clientes', 'Reservas']);
        $this->set(compact('xservNotificacione'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $xservNotificacione = $this->XservNotificaciones->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservNotificacione = $this->XservNotificaciones->patchEntity($xservNotificacione, $this->request->getData());
            if ($this->XservNotificaciones->save($xservNotificacione)) {
                $this->Flash->success(__('The xserv notificacione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv notificacione could not be saved. Please, try again.'));
        }
        $usuarios = $this->XservNotificaciones->Usuarios->find('list', limit: 200)->all();
        $clientes = $this->XservNotificaciones->Clientes->find('list', limit: 200)->all();
        $reservas = $this->XservNotificaciones->Reservas->find('list', limit: 200)->all();
        $this->set(compact('xservNotificacione', 'usuarios', 'clientes', 'reservas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xserv Notificacione id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $xservNotificacione = $this->XservNotificaciones->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservNotificacione = $this->XservNotificaciones->patchEntity($xservNotificacione, $this->request->getData());
            if ($this->XservNotificaciones->save($xservNotificacione)) {
                $this->Flash->success(__('The xserv notificacione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv notificacione could not be saved. Please, try again.'));
        }
        $usuarios = $this->XservNotificaciones->Usuarios->find('list', limit: 200)->all();
        $clientes = $this->XservNotificaciones->Clientes->find('list', limit: 200)->all();
        $reservas = $this->XservNotificaciones->Reservas->find('list', limit: 200)->all();
        $this->set(compact('xservNotificacione', 'usuarios', 'clientes', 'reservas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xserv Notificacione id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $xservNotificacione = $this->XservNotificaciones->get($id);
        if ($this->XservNotificaciones->delete($xservNotificacione)) {
            $this->Flash->success(__('The xserv notificacione has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv notificacione could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

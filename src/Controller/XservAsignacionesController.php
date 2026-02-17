<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservAsignaciones Controller
 *
 * @property \App\Model\Table\XservAsignacionesTable $XservAsignaciones
 */
class XservAsignacionesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $query = $this->XservAsignaciones->find()
            ->contain(['Reservas', 'Chofers', 'Vehiculos', 'AsignadoPors']);
        $xservAsignaciones = $this->paginate($query);

        $this->set(compact('xservAsignaciones'));
    }

    /**
     * View method
     *
     * @param string|null $id Xserv Asignacione id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $this->Authorization->skipAuthorization();
        $xservAsignacione = $this->XservAsignaciones->get($id, contain: ['Reservas', 'Chofers', 'Vehiculos', 'AsignadoPors']);
        $this->set(compact('xservAsignacione'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();
        $xservAsignacione = $this->XservAsignaciones->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservAsignacione = $this->XservAsignaciones->patchEntity($xservAsignacione, $this->request->getData());
            if ($this->XservAsignaciones->save($xservAsignacione)) {
                $this->Flash->success(__('The xserv asignacione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv asignacione could not be saved. Please, try again.'));
        }
        $reservas = $this->XservAsignaciones->Reservas->find('list', limit: 200)->all();
        $chofers = $this->XservAsignaciones->Chofers->find('list', limit: 200)->all();
        $vehiculos = $this->XservAsignaciones->Vehiculos->find('list', limit: 200)->all();
        $asignadoPors = $this->XservAsignaciones->AsignadoPors->find('list', limit: 200)->all();
        $this->set(compact('xservAsignacione', 'reservas', 'chofers', 'vehiculos', 'asignadoPors'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xserv Asignacione id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $this->Authorization->skipAuthorization();
        $xservAsignacione = $this->XservAsignaciones->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservAsignacione = $this->XservAsignaciones->patchEntity($xservAsignacione, $this->request->getData());
            if ($this->XservAsignaciones->save($xservAsignacione)) {
                $this->Flash->success(__('The xserv asignacione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv asignacione could not be saved. Please, try again.'));
        }
        $reservas = $this->XservAsignaciones->Reservas->find('list', limit: 200)->all();
        $chofers = $this->XservAsignaciones->Chofers->find('list', limit: 200)->all();
        $vehiculos = $this->XservAsignaciones->Vehiculos->find('list', limit: 200)->all();
        $asignadoPors = $this->XservAsignaciones->AsignadoPors->find('list', limit: 200)->all();
        $this->set(compact('xservAsignacione', 'reservas', 'chofers', 'vehiculos', 'asignadoPors'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xserv Asignacione id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'delete']);
        $xservAsignacione = $this->XservAsignaciones->get($id);
        if ($this->XservAsignaciones->delete($xservAsignacione)) {
            $this->Flash->success(__('The xserv asignacione has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv asignacione could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

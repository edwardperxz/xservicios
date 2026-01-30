<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservIncidenciasViaje Controller
 *
 * @property \App\Model\Table\XservIncidenciasViajeTable $XservIncidenciasViaje
 */
class XservIncidenciasViajeController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->XservIncidenciasViaje->find()
            ->contain(['Ejecucions']);
        $xservIncidenciasViaje = $this->paginate($query);

        $this->set(compact('xservIncidenciasViaje'));
    }

    /**
     * View method
     *
     * @param string|null $id Xserv Incidencias Viaje id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $xservIncidenciasViaje = $this->XservIncidenciasViaje->get($id, contain: ['Ejecucions']);
        $this->set(compact('xservIncidenciasViaje'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $xservIncidenciasViaje = $this->XservIncidenciasViaje->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservIncidenciasViaje = $this->XservIncidenciasViaje->patchEntity($xservIncidenciasViaje, $this->request->getData());
            if ($this->XservIncidenciasViaje->save($xservIncidenciasViaje)) {
                $this->Flash->success(__('The xserv incidencias viaje has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv incidencias viaje could not be saved. Please, try again.'));
        }
        $ejecucions = $this->XservIncidenciasViaje->Ejecucions->find('list', limit: 200)->all();
        $this->set(compact('xservIncidenciasViaje', 'ejecucions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xserv Incidencias Viaje id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $xservIncidenciasViaje = $this->XservIncidenciasViaje->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservIncidenciasViaje = $this->XservIncidenciasViaje->patchEntity($xservIncidenciasViaje, $this->request->getData());
            if ($this->XservIncidenciasViaje->save($xservIncidenciasViaje)) {
                $this->Flash->success(__('The xserv incidencias viaje has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv incidencias viaje could not be saved. Please, try again.'));
        }
        $ejecucions = $this->XservIncidenciasViaje->Ejecucions->find('list', limit: 200)->all();
        $this->set(compact('xservIncidenciasViaje', 'ejecucions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xserv Incidencias Viaje id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $xservIncidenciasViaje = $this->XservIncidenciasViaje->get($id);
        if ($this->XservIncidenciasViaje->delete($xservIncidenciasViaje)) {
            $this->Flash->success(__('The xserv incidencias viaje has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv incidencias viaje could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

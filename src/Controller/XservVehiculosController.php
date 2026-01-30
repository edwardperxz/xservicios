<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservVehiculos Controller
 *
 * @property \App\Model\Table\XservVehiculosTable $XservVehiculos
 */
class XservVehiculosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->XservVehiculos->find();
        $xservVehiculos = $this->paginate($query);

        $this->set(compact('xservVehiculos'));
    }

    /**
     * View method
     *
     * @param string|null $id Xserv Vehiculo id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $xservVehiculo = $this->XservVehiculos->get($id, contain: []);
        $this->set(compact('xservVehiculo'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $xservVehiculo = $this->XservVehiculos->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservVehiculo = $this->XservVehiculos->patchEntity($xservVehiculo, $this->request->getData());
            if ($this->XservVehiculos->save($xservVehiculo)) {
                $this->Flash->success(__('The xserv vehiculo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv vehiculo could not be saved. Please, try again.'));
        }
        $this->set(compact('xservVehiculo'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xserv Vehiculo id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $xservVehiculo = $this->XservVehiculos->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservVehiculo = $this->XservVehiculos->patchEntity($xservVehiculo, $this->request->getData());
            if ($this->XservVehiculos->save($xservVehiculo)) {
                $this->Flash->success(__('The xserv vehiculo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv vehiculo could not be saved. Please, try again.'));
        }
        $this->set(compact('xservVehiculo'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xserv Vehiculo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $xservVehiculo = $this->XservVehiculos->get($id);
        if ($this->XservVehiculos->delete($xservVehiculo)) {
            $this->Flash->success(__('The xserv vehiculo has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv vehiculo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

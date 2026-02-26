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
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authorization->skipAuthorization();
        
        // Usar layout admin si el usuario es admin
        $user = $this->Authentication->getIdentity();
        if ($user && $user->rol === 'admin') {
            $this->viewBuilder()->setLayout('admin');
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        
        $user = $this->Authentication->getIdentity();
        $isAdmin = $user && $user->rol === 'admin';
        
        $query = $this->XservAsignaciones->find()
            ->contain(['Chofers', 'Vehiculos']);
        
        $filters = $this->request->getQuery();
        
        if (!empty($filters['estado_asignacion'])) {
            $query->where(['estado_asignacion' => $filters['estado_asignacion']]);
        }
        
        $xservAsignaciones = $this->paginate($query);

        $this->set(compact('xservAsignaciones', 'filters'));
        
        if ($isAdmin) {
            $this->render('admin_index');
        }
    }

    /**
     * View method
     *
    * @param string|null $id Xserv Asignacion id.
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
                $this->Flash->success(__('The xserv asignacion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv asignacion could not be saved. Please, try again.'));
        }
        $reservas = $this->XservAsignaciones->Reservas->find('list', [
            'keyField' => 'id',
            'valueField' => 'codigo_reserva'
        ])->order(['codigo_reserva' => 'ASC'])->all();
        
        $chofers = $this->XservAsignaciones->Chofers->find('list', [
            'keyField' => 'id',
            'valueField' => function($chofer) {
                return $chofer->usuario->nombre ?? 'Sin nombre';
            }
        ])->contain(['Usuarios'])->order(['Usuarios.nombre' => 'ASC'])->all();
        
        $vehiculos = $this->XservAsignaciones->Vehiculos->find('list', [
            'keyField' => 'id',
            'valueField' => function($vehiculo) {
                $display = $vehiculo->placa;
                if ($vehiculo->nombre_unidad) {
                    $display .= ' - ' . $vehiculo->nombre_unidad;
                }
                return $display;
            }
        ])->order(['placa' => 'ASC'])->all();
        
        $asignadoPors = $this->XservAsignaciones->AsignadoPors->find('list', [
            'keyField' => 'id',
            'valueField' => function($usuario) {
                return $usuario->username . ' - ' . $usuario->nombre;
            }
        ])->order(['username' => 'ASC'])->all();
        
        $this->set(compact('xservAsignacione', 'reservas', 'chofers', 'vehiculos', 'asignadoPors'));
    }

    /**
     * Edit method
     *
    * @param string|null $id Xserv Asignacion id.
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
                $this->Flash->success(__('The xserv asignacion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv asignacion could not be saved. Please, try again.'));
        }
        $reservas = $this->XservAsignaciones->Reservas->find('list', [
            'keyField' => 'id',
            'valueField' => 'codigo_reserva'
        ])->order(['codigo_reserva' => 'ASC'])->all();
        
        $chofers = $this->XservAsignaciones->Chofers->find('list', [
            'keyField' => 'id',
            'valueField' => function($chofer) {
                return $chofer->usuario->nombre ?? 'Sin nombre';
            }
        ])->contain(['Usuarios'])->order(['Usuarios.nombre' => 'ASC'])->all();
        
        $vehiculos = $this->XservAsignaciones->Vehiculos->find('list', [
            'keyField' => 'id',
            'valueField' => function($vehiculo) {
                $display = $vehiculo->placa;
                if ($vehiculo->nombre_unidad) {
                    $display .= ' - ' . $vehiculo->nombre_unidad;
                }
                return $display;
            }
        ])->order(['placa' => 'ASC'])->all();
        
        $asignadoPors = $this->XservAsignaciones->AsignadoPors->find('list', [
            'keyField' => 'id',
            'valueField' => function($usuario) {
                return $usuario->username . ' - ' . $usuario->nombre;
            }
        ])->order(['username' => 'ASC'])->all();
        
        $this->set(compact('xservAsignacione', 'reservas', 'chofers', 'vehiculos', 'asignadoPors'));
    }

    /**
     * Delete method
     *
    * @param string|null $id Xserv Asignacion id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'delete']);
        $xservAsignacione = $this->XservAsignaciones->get($id);
        if ($this->XservAsignaciones->delete($xservAsignacione)) {
            $this->Flash->success(__('The xserv asignacion has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv asignacion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservEjecucionViajes Controller
 *
 * @property \App\Model\Table\XservEjecucionViajesTable $XservEjecucionViajes
 */
class XservEjecucionViajesController extends AppController
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
        $user = $this->Authentication->getIdentity();
        $isAdmin = $user && $user->rol === 'admin';
        $filters = $this->request->getQuery();

        $query = $this->XservEjecucionViajes->find()
            ->contain(['Asignacions']);

        if (!empty($filters['estado_ejecucion'])) {
            $query->where(['estado_ejecucion' => $filters['estado_ejecucion']]);
        }

        if (!empty($filters['asignacion_id'])) {
            $query->where(['asignacion_id' => $filters['asignacion_id']]);
        }

        $xservEjecucionViajes = $this->paginate($query);

        // Obtener valores distinctos para filtros
        $estados = $this->XservEjecucionViajes->find()
            ->select(['estado_ejecucion'])
            ->distinct(['estado_ejecucion'])
            ->where(['estado_ejecucion IS NOT' => null])
            ->order(['estado_ejecucion' => 'ASC'])
            ->all()
            ->extract('estado_ejecucion')
            ->toList();

        $asignaciones = $this->XservEjecucionViajes->Asignacions->find('list', ['keyField' => 'id', 'valueField' => 'id'])
            ->order(['id' => 'ASC'])
            ->toArray();

        $this->set(compact('xservEjecucionViajes', 'filters', 'estados', 'asignaciones'));

        if ($isAdmin) {
            $this->render('admin_index');
        }
    }

    /**
     * Admin index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function adminIndex()
    {
        $user = $this->Authentication->getIdentity();
        if (!$user || $user->rol !== 'admin') {
            return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'profile']);
        }

        $this->viewBuilder()->setLayout('admin');
        $filters = $this->request->getQuery();

        $query = $this->XservEjecucionViajes->find()
            ->contain(['Asignacions']);

        if (!empty($filters['estado_ejecucion'])) {
            $query->where(['estado_ejecucion' => $filters['estado_ejecucion']]);
        }

        if (!empty($filters['asignacion_id'])) {
            $query->where(['asignacion_id' => $filters['asignacion_id']]);
        }

        $xservEjecucionViajes = $this->paginate($query);

        // Obtener valores distinctos para filtros
        $estados = $this->XservEjecucionViajes->find()
            ->select(['estado_ejecucion'])
            ->distinct(['estado_ejecucion'])
            ->where(['estado_ejecucion IS NOT' => null])
            ->order(['estado_ejecucion' => 'ASC'])
            ->all()
            ->extract('estado_ejecucion')
            ->toList();

        $asignaciones = $this->XservEjecucionViajes->Asignacions->find('list', ['keyField' => 'id', 'valueField' => 'id'])
            ->order(['id' => 'ASC'])
            ->toArray();

        $this->set(compact('xservEjecucionViajes', 'filters', 'estados', 'asignaciones'));
        $this->render('admin_index');
    }

    /**
     * View method
     *
     * @param string|null $id Xserv Ejecucion Viaje id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $xservEjecucionViaje = $this->XservEjecucionViajes->get($id, contain: ['Asignacions']);
        $this->set(compact('xservEjecucionViaje'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $xservEjecucionViaje = $this->XservEjecucionViajes->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservEjecucionViaje = $this->XservEjecucionViajes->patchEntity($xservEjecucionViaje, $this->request->getData());
            if ($this->XservEjecucionViajes->save($xservEjecucionViaje)) {
                $this->Flash->success(__('The xserv ejecucion viaje has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv ejecucion viaje could not be saved. Please, try again.'));
        }
        $asignacions = $this->XservEjecucionViajes->Asignacions->find('list', [
            'keyField' => 'id',
            'valueField' => function($asignacion) {
                return $asignacion->reserva->codigo_reserva . ' - ' . $asignacion->chofer->usuario->nombre . ' / ' . $asignacion->vehiculo->placa;
            }
        ])->contain(['Reservas', 'Chofers' => ['Usuarios'], 'Vehiculos'])->order(['Reservas.codigo_reserva' => 'ASC'])->all();
        $this->set(compact('xservEjecucionViaje', 'asignacions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xserv Ejecucion Viaje id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $xservEjecucionViaje = $this->XservEjecucionViajes->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservEjecucionViaje = $this->XservEjecucionViajes->patchEntity($xservEjecucionViaje, $this->request->getData());
            if ($this->XservEjecucionViajes->save($xservEjecucionViaje)) {
                $this->Flash->success(__('The xserv ejecucion viaje has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv ejecucion viaje could not be saved. Please, try again.'));
        }
        $asignacions = $this->XservEjecucionViajes->Asignacions->find('list', [
            'keyField' => 'id',
            'valueField' => function($asignacion) {
                return $asignacion->reserva->codigo_reserva . ' - ' . $asignacion->chofer->usuario->nombre . ' / ' . $asignacion->vehiculo->placa;
            }
        ])->contain(['Reservas', 'Chofers' => ['Usuarios'], 'Vehiculos'])->order(['Reservas.codigo_reserva' => 'ASC'])->all();
        $this->set(compact('xservEjecucionViaje', 'asignacions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xserv Ejecucion Viaje id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $xservEjecucionViaje = $this->XservEjecucionViajes->get($id);
        if ($this->XservEjecucionViajes->delete($xservEjecucionViaje)) {
            $this->Flash->success(__('The xserv ejecucion viaje has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv ejecucion viaje could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

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

    /**
     * Panel de chofer - Ver asignaciones y ejecutar viajes
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function choferPanel()
    {
        $user = $this->Authentication->getIdentity();
        
        // Verificar que el usuario sea chofer
        if (!$user || $user->rol !== 'chofer') {
            return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'profile']);
        }

        // Obtener el ID del chofer asociado al usuario
        $choferesTable = TableRegistry::getTableLocator()->get('XservChoferes');
        $chofer = $choferesTable->find()
            ->where(['usuario_id' => $user->id])
            ->first();

        if (!$chofer) {
            $this->Flash->error('No se encontró el perfil de chofer asociado.');
            return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'profile']);
        }

        // Obtener asignaciones del chofer
        $asignacionesTable = TableRegistry::getTableLocator()->get('XservAsignaciones');
        $asignaciones = $asignacionesTable->find()
            ->where(['chofer_id' => $chofer->id])
            ->contain([
                'Reservas' => ['XservServicios', 'XservClientes'],
                'Vehiculos',
                'XservEjecucionViajes' => ['XservIncidenciasViaje']
            ])
            ->order(['fecha_inicio_pactada' => 'DESC'])
            ->all();

        $this->viewBuilder()->setLayout('admin');
        $this->set(compact('asignaciones', 'chofer'));
    }

    /**
     * Iniciar servicio - API endpoint
     *
     * @return \Cake\Http\Response|null JSON response
     */
    public function iniciarServicio()
    {
        $this->request->allowMethod(['post']);
        $this->viewBuilder()->setClassName('Json');
        
        $user = $this->Authentication->getIdentity();
        
        if (!$user || $user->rol !== 'chofer') {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'No autorizado']));
        }

        $data = $this->request->getData();
        $asignacionId = $data['asignacion_id'] ?? null;
        $kmInicio = $data['km_inicio'] ?? null;
        $latInicio = $data['lat_inicio'] ?? null;
        $lngInicio = $data['lng_inicio'] ?? null;

        if (!$asignacionId || !$kmInicio || !$latInicio || !$lngInicio) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Datos incompletos']));
        }

        // Verificar que la asignación pertenece al chofer
        $choferesTable = TableRegistry::getTableLocator()->get('XservChoferes');
        $chofer = $choferesTable->find()
            ->where(['usuario_id' => $user->id])
            ->first();

        if (!$chofer) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Chofer no encontrado']));
        }

        $asignacionesTable = TableRegistry::getTableLocator()->get('XservAsignaciones');
        $asignacion = $asignacionesTable->get($asignacionId);
        
        if ($asignacion->chofer_id != $chofer->id) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Asignación no pertenece a este chofer']));
        }

        // Crear registro de ejecución
        $ejecucion = $this->XservEjecucionViajes->newEmptyEntity();
        $ejecucionData = [
            'asignacion_id' => $asignacionId,
            'hora_inicio_real' => new \DateTime(),
            'km_inicio' => $kmInicio,
            'lat_inicio' => $latInicio,
            'lng_inicio' => $lngInicio,
            'estado_ejecucion' => 'en_progreso'
        ];
        
        $ejecucion = $this->XservEjecucionViajes->patchEntity($ejecucion, $ejecucionData);
        
        if ($this->XservEjecucionViajes->save($ejecucion)) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => true, 'message' => 'Servicio iniciado correctamente', 'ejecucion_id' => $ejecucion->id]));
        } else {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Error al iniciar servicio']));
        }
    }

    /**
     * Finalizar servicio - API endpoint
     *
     * @return \Cake\Http\Response|null JSON response
     */
    public function finalizarServicio()
    {
        $this->request->allowMethod(['post']);
        $this->viewBuilder()->setClassName('Json');
        
        $user = $this->Authentication->getIdentity();
        
        if (!$user || $user->rol !== 'chofer') {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'No autorizado']));
        }

        $data = $this->request->getData();
        $ejecucionId = $data['ejecucion_id'] ?? null;
        $kmFin = $data['km_fin'] ?? null;
        $latFin = $data['lat_fin'] ?? null;
        $lngFin = $data['lng_fin'] ?? null;
        $observaciones = $data['observaciones_finales'] ?? null;

        if (!$ejecucionId || !$kmFin || !$latFin || !$lngFin) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Datos incompletos']));
        }

        // Obtener ejecución y verificar que pertenece al chofer
        $choferesTable = TableRegistry::getTableLocator()->get('XservChoferes');
        $chofer = $choferesTable->find()
            ->where(['usuario_id' => $user->id])
            ->first();

        if (!$chofer) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Chofer no encontrado']));
        }

        $ejecucionesTable = TableRegistry::getTableLocator()->get('XservEjecucionViajes');
        $ejecucion = $ejecucionesTable->get($ejecucionId, ['contain' => ['Asignacions']]);
        
        if ($ejecucion->asignacion->chofer_id != $chofer->id) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Ejecución no pertenece a este chofer']));
        }

        // Actualizar ejecución
        $ejecucionData = [
            'hora_fin_real' => new \DateTime(),
            'km_fin' => $kmFin,
            'lat_fin' => $latFin,
            'lng_fin' => $lngFin,
            'observaciones_finales' => $observaciones,
            'estado_ejecucion' => 'completado'
        ];
        
        $ejecucion = $this->XservEjecucionViajes->patchEntity($ejecucion, $ejecucionData);
        
        if ($this->XservEjecucionViajes->save($ejecucion)) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => true, 'message' => 'Servicio finalizado correctamente']));
        } else {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Error al finalizar servicio']));
        }
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;
/**
 * XservIncidenciasViaje Controller
 *
 * @property \App\Model\Table\XservIncidenciasViajeTable $XservIncidenciasViaje
 */
class XservIncidenciasViajeController extends AppController
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

        $query = $this->XservIncidenciasViaje->find()
            ->contain(['Ejecucions']);

        if ($filters['resuelto'] ?? '' !== '') {
            $query->where(['resuelto' => (int)$filters['resuelto']]);
        }

        if (!empty($filters['tipo_incidencia'])) {
            $query->where(['tipo_incidencia' => $filters['tipo_incidencia']]);
        }

        if (!empty($filters['severidad'])) {
            $query->where(['severidad' => $filters['severidad']]);
        }

        $xservIncidenciasViaje = $this->paginate($query);

        // Obtener valores distinctos para filtros
        $tiposIncidencia = $this->XservIncidenciasViaje->find()
            ->select(['tipo_incidencia'])
            ->distinct(['tipo_incidencia'])
            ->where(['tipo_incidencia IS NOT' => null])
            ->order(['tipo_incidencia' => 'ASC'])
            ->all()
            ->extract('tipo_incidencia')
            ->toList();

        $severidades = $this->XservIncidenciasViaje->find()
            ->select(['severidad'])
            ->distinct(['severidad'])
            ->where(['severidad IS NOT' => null])
            ->order(['severidad' => 'ASC'])
            ->all()
            ->extract('severidad')
            ->toList();

        $this->set(compact('xservIncidenciasViaje', 'filters', 'tiposIncidencia', 'severidades'));

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

        $query = $this->XservIncidenciasViaje->find()
            ->contain(['Ejecucions']);

        if ($filters['resuelto'] ?? '' !== '') {
            $query->where(['resuelto' => (int)$filters['resuelto']]);
        }

        if (!empty($filters['tipo_incidencia'])) {
            $query->where(['tipo_incidencia' => $filters['tipo_incidencia']]);
        }

        if (!empty($filters['severidad'])) {
            $query->where(['severidad' => $filters['severidad']]);
        }

        $xservIncidenciasViaje = $this->paginate($query);

        // Obtener valores distinctos para filtros
        $tiposIncidencia = $this->XservIncidenciasViaje->find()
            ->select(['tipo_incidencia'])
            ->distinct(['tipo_incidencia'])
            ->where(['tipo_incidencia IS NOT' => null])
            ->order(['tipo_incidencia' => 'ASC'])
            ->all()
            ->extract('tipo_incidencia')
            ->toList();

        $severidades = $this->XservIncidenciasViaje->find()
            ->select(['severidad'])
            ->distinct(['severidad'])
            ->where(['severidad IS NOT' => null])
            ->order(['severidad' => 'ASC'])
            ->all()
            ->extract('severidad')
            ->toList();

        $this->set(compact('xservIncidenciasViaje', 'filters', 'tiposIncidencia', 'severidades'));
        $this->render('admin_index');
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
            $data = $this->request->getData();
            // Procesar campo GPS unificado
            if (!empty($data['direccion_gps_incidencia'])) {
                $gps = trim($data['direccion_gps_incidencia']);
                $coords = array_map('trim', explode(',', $gps));
                if (count($coords) === 2) {
                    $data['latitud_incidencia'] = (float)$coords[0];
                    $data['longitud_incidencia'] = (float)$coords[1];
                }
            }
            unset($data['direccion_gps_incidencia']);
            
            $xservIncidenciasViaje = $this->XservIncidenciasViaje->patchEntity($xservIncidenciasViaje, $data);
            if ($this->XservIncidenciasViaje->save($xservIncidenciasViaje)) {
                $this->Flash->success(__('The xserv incidencias viaje has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv incidencias viaje could not be saved. Please, try again.'));
        }
        $ejecucions = $this->XservIncidenciasViaje->Ejecucions->find('list', [
            'keyField' => 'id',
            'valueField' => function($ejecucion) {
                return $ejecucion->asignacion->reserva->codigo_reserva . ' - Estado: ' . $ejecucion->estado_viaje;
            }
        ])->contain(['Asignacions' => ['Reservas']])->order(['Ejecucions.id' => 'DESC'])->all();
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
            $data = $this->request->getData();
            // Procesar campo GPS unificado
            if (!empty($data['direccion_gps_incidencia'])) {
                $gps = trim($data['direccion_gps_incidencia']);
                $coords = array_map('trim', explode(',', $gps));
                if (count($coords) === 2) {
                    $data['latitud_incidencia'] = (float)$coords[0];
                    $data['longitud_incidencia'] = (float)$coords[1];
                }
            }
            unset($data['direccion_gps_incidencia']);
            
            $xservIncidenciasViaje = $this->XservIncidenciasViaje->patchEntity($xservIncidenciasViaje, $data);
            if ($this->XservIncidenciasViaje->save($xservIncidenciasViaje)) {
                $this->Flash->success(__('The xserv incidencias viaje has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv incidencias viaje could not be saved. Please, try again.'));
        }
        $ejecucions = $this->XservIncidenciasViaje->Ejecucions->find('list', [
            'keyField' => 'id',
            'valueField' => function($ejecucion) {
                return $ejecucion->asignacion->reserva->codigo_reserva . ' - Estado: ' . $ejecucion->estado_viaje;
            }
        ])->contain(['Asignacions' => ['Reservas']])->order(['Ejecucions.id' => 'DESC'])->all();
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

    /**
     * Reportar incidencia - API endpoint para choferes
     *
     * @return \Cake\Http\Response|null JSON response
     */
    public function reportarIncidencia()
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
        $tipoIncidencia = $data['tipo_incidencia'] ?? null;
        $descripcion = $data['descripcion'] ?? '';
        $severidad = $data['severidad'] ?? 'baja';
        $latitud = $data['latitud_incidencia'] ?? null;
        $longitud = $data['longitud_incidencia'] ?? null;

        if (!$ejecucionId || !$tipoIncidencia || !$latitud || !$longitud) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Datos incompletos']));
        }

        // Verificar que la ejecución pertenece al chofer
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

        // Crear incidencia
        $incidencia = $this->XservIncidenciasViaje->newEmptyEntity();
        $incidenciaData = [
            'ejecucion_id' => $ejecucionId,
            'tipo_incidencia' => $tipoIncidencia,
            'descripcion' => $descripcion,
            'latitud_incidencia' => $latitud,
            'longitud_incidencia' => $longitud,
            'severidad' => $severidad,
            'resuelto' => 0
        ];
        
        $incidencia = $this->XservIncidenciasViaje->patchEntity($incidencia, $incidenciaData);
        
        if ($this->XservIncidenciasViaje->save($incidencia)) {
            // Actualizar estado de ejecución si la severidad es crítica
            if ($severidad === 'critica') {
                $ejecucion->estado_ejecucion = 'detenido_incidencia';
                $this->XservEjecucionViajes->save($ejecucion);
            }
            
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => true, 'message' => 'Incidencia reportada correctamente', 'incidencia_id' => $incidencia->id]));
        } else {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Error al reportar incidencia']));
        }
    }

    /**
     * Resolver incidencia - API endpoint para choferes
     *
     * @return \Cake\Http\Response|null JSON response
     */
    public function resolverIncidencia()
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
        $incidenciaId = $data['incidencia_id'] ?? null;

        if (!$incidenciaId) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'ID de incidencia requerido']));
        }

        // Verificar que la incidencia pertenece al chofer
        $choferesTable = TableRegistry::getTableLocator()->get('XservChoferes');
        $chofer = $choferesTable->find()
            ->where(['usuario_id' => $user->id])
            ->first();

        if (!$chofer) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Chofer no encontrado']));
        }

        $incidencia = $this->XservIncidenciasViaje->get($incidenciaId, ['contain' => ['Ejecucions' => ['Asignacions']]]);
        
        if ($incidencia->ejecucion->asignacion->chofer_id != $chofer->id) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Incidencia no pertenece a este chofer']));
        }

        // Marcar como resuelta
        $incidencia->resuelto = 1;
        
        if ($this->XservIncidenciasViaje->save($incidencia)) {
            // Si era crítica, restaurar estado de ejecución
            if ($incidencia->severidad === 'critica' && $incidencia->ejecucion->estado_ejecucion === 'detenido_incidencia') {
                $ejecucionesTable = TableRegistry::getTableLocator()->get('XservEjecucionViajes');
                $ejecucion = $ejecucionesTable->get($incidencia->ejecucion_id);
                $ejecucion->estado_ejecucion = 'en_progreso';
                $ejecucionesTable->save($ejecucion);
            }
            
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => true, 'message' => 'Incidencia resuelta correctamente']));
        } else {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Error al resolver incidencia']));
        }
    }
}


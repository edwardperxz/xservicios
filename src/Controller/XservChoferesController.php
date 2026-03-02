<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservChoferes Controller
 *
 * @property \App\Model\Table\XservChoferesTable $XservChoferes
 */
class XservChoferesController extends AppController
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
     * Profile method - Show driver profile with dynamic data
     *
     * @param string|null $id Xserv Chofer id (optional, gets current user's driver if not provided)
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function profile(?string $id = null)
    {
        $this->Authorization->skipAuthorization();
        
        $currentUser = $this->Authentication->getIdentity();
        
        // If no ID provided, get the current user's driver profile
        if (!$id && $currentUser) {
            $chofer = $this->XservChoferes->find()
                ->contain(['Usuarios'])
                ->where(['usuario_id' => $currentUser->id])
                ->first();
            
            if (!$chofer) {
                return $this->redirect(['controller' => 'Pages', 'action' => 'home']);
            }
        } else {
            // Get specific driver profile
            $chofer = $this->XservChoferes->get($id, contain: ['Usuarios']);
        }
        
        // Load models for stats
        $this->loadModel('XservAsignaciones');
        $this->loadModel('XservValoraciones');
        
        // Get assignments for this driver
        $asignacionesIds = $this->XservAsignaciones->find()
            ->where(['chofer_id' => $chofer->id])
            ->select(['id', 'reserva_id'])
            ->toArray();
        
        $reservasIds = array_column($asignacionesIds, 'reserva_id');
        
        // Calculate statistics
        $totalViajes = count($asignacionesIds);
        $viajuesCompletados = $this->XservAsignaciones->find()
            ->where(['chofer_id' => $chofer->id, 'estado_asignacion' => 'finalizada'])
            ->count();
        
        $promediCalificacion = 0;
        $totalValoraciones = 0;
        
        if (!empty($reservasIds)) {
            $promediCalificacion = $this->XservValoraciones->find()
                ->select(['promedio' => $this->XservValoraciones->find()->func('AVG', ['calificacion'])])
                ->whereInList('reserva_id', $reservasIds)
                ->first()
                ->promedio ?? 0;
            
            $totalValoraciones = $this->XservValoraciones->find()
                ->whereInList('reserva_id', $reservasIds)
                ->count();
        }
        
        // Get recent ratings
        $valoraciones = $this->XservValoraciones->find()
            ->whereInList('reserva_id', $reservasIds)
            ->contain(['Reservas.Clientes.Usuarios'])
            ->order(['created_at' => 'DESC'])
            ->limit(5)
            ->all();
        
        // Get recent activity
        $actividadReciente = $this->XservAsignaciones->find()
            ->where(['chofer_id' => $chofer->id])
            ->contain(['Reservas.Clientes.Usuarios'])
            ->order(['created_at' => 'DESC'])
            ->limit(6)
            ->all();
        
        $estadisticas = [
            'total_viajes' => $totalViajes,
            'viajes_completados' => $viajuesCompletados,
            'promedio_calificacion' => round((float)$promediCalificacion, 1),
            'total_valoraciones' => $totalValoraciones,
            'clientes_atendidos' => count(array_unique(array_column($actividadReciente->toArray(), 'reserva_id'))),
        ];
        
        $this->set(compact('chofer', 'estadisticas', 'valoraciones', 'actividadReciente'));
        $this->viewBuilder()->setLayout('');
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
        
        $query = $this->XservChoferes->find()
            ->contain(['Usuarios']);
        
        $filters = $this->request->getQuery();
        
        if (!empty($filters['disponibilidad'])) {
            $query->where(['disponibilidad' => $filters['disponibilidad']]);
        }
        
        if (!empty($filters['estado'])) {
            $query->where(['estado' => $filters['estado']]);
        }
        
        if (!empty($filters['nombre'])) {
            $query->where(['Usuarios.nombre LIKE' => '%' . $filters['nombre'] . '%']);
        }
        
        $xservChoferes = $this->paginate($query);
        
        $this->set(compact('xservChoferes', 'filters'));
        
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
        $this->Authorization->skipAuthorization();

        $user = $this->Authentication->getIdentity();
        if (!$user || $user->rol !== 'admin') {
            return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'profile']);
        }

        $this->viewBuilder()->setLayout('admin');

        $query = $this->XservChoferes->find()
            ->contain(['Usuarios']);

        $filters = $this->request->getQuery();

        if (!empty($filters['disponibilidad'])) {
            $query->where(['disponibilidad' => $filters['disponibilidad']]);
        }

        if (!empty($filters['estado'])) {
            $query->where(['estado' => $filters['estado']]);
        }

        if (!empty($filters['nombre'])) {
            $query->where(['Usuarios.nombre LIKE' => '%' . $filters['nombre'] . '%']);
        }

        $xservChoferes = $this->paginate($query);

        $this->set(compact('xservChoferes', 'filters'));
        $this->render('admin_index');
    }

    /**
     * View method
     *
    * @param string|null $id Xserv Chofer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $this->Authorization->skipAuthorization();
        $xservChofere = $this->XservChoferes->get($id, contain: ['Usuarios']);
        $this->set(compact('xservChofere'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();
        $xservChofere = $this->XservChoferes->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            // Manejar carga de archivo
            if (!empty($data['foto']) && $data['foto']->getSize() > 0) {
                $uploadDir = WWW_ROOT . 'img' . DS . 'choferes' . DS;
                
                // Crear directorio si no existe
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                $file = $data['foto'];
                $filename = time() . '_' . $file->getClientFilename();
                $filepath = $uploadDir . $filename;
                
                // Mover archivo cargado
                try {
                    $file->moveTo($filepath);
                    $data['foto_url'] = '/img/choferes/' . $filename;
                } catch (\Exception $e) {
                    $this->Flash->error(__('Error al subir la imagen.'));
                    $this->set(compact('xservChofere'));
                    return;
                }
            }
            
            // Eliminar la clave 'foto' si existe (no es parte del modelo)
            unset($data['foto']);
            
            $xservChofere = $this->XservChoferes->patchEntity($xservChofere, $data);
            if ($this->XservChoferes->save($xservChofere)) {
                $this->Flash->success(__('The xserv chofer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv chofer could not be saved. Please, try again.'));
        }
        $usuarios = $this->XservChoferes->Usuarios->find('list', [
            'keyField' => 'id',
            'valueField' => function($usuario) {
                return $usuario->username . ' - ' . $usuario->nombre;
            }
        ])->where(['rol' => 'operador'])->order(['username' => 'ASC'])->all();
        $this->set(compact('xservChofere', 'usuarios'));
    }

    /**
     * Edit method
     *
    * @param string|null $id Xserv Chofer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $this->Authorization->skipAuthorization();
        $xservChofere = $this->XservChoferes->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            
            // Manejar carga de archivo
            if (!empty($data['foto']) && $data['foto']->getSize() > 0) {
                $uploadDir = WWW_ROOT . 'img' . DS . 'choferes' . DS;
                
                // Crear directorio si no existe
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                // Eliminar foto anterior si existe
                if (!empty($xservChofere->foto_url)) {
                    $oldPath = WWW_ROOT . ltrim($xservChofere->foto_url, '/');
                    if (is_file($oldPath)) {
                        unlink($oldPath);
                    }
                }
                
                $file = $data['foto'];
                $filename = time() . '_' . $file->getClientFilename();
                $filepath = $uploadDir . $filename;
                
                // Mover archivo cargado
                try {
                    $file->moveTo($filepath);
                    $data['foto_url'] = '/img/choferes/' . $filename;
                } catch (\Exception $e) {
                    $this->Flash->error(__('Error al subir la imagen.'));
                    $this->set(compact('xservChofere'));
                    return;
                }
            }
            
            // Eliminar la clave 'foto' si existe (no es parte del modelo)
            unset($data['foto']);
            
            $xservChofere = $this->XservChoferes->patchEntity($xservChofere, $data);
            if ($this->XservChoferes->save($xservChofere)) {
                $this->Flash->success(__('The xserv chofer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv chofer could not be saved. Please, try again.'));
        }
        $usuarios = $this->XservChoferes->Usuarios->find('list', [
            'keyField' => 'id',
            'valueField' => function($usuario) {
                return $usuario->username . ' - ' . $usuario->nombre;
            }
        ])->where(['rol' => 'operador'])->order(['username' => 'ASC'])->all();
        $this->set(compact('xservChofere', 'usuarios'));
    }

    /**
     * Delete method
     *
    * @param string|null $id Xserv Chofer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'delete']);
        $xservChofere = $this->XservChoferes->get($id);
        if ($this->XservChoferes->delete($xservChofere)) {
            $this->Flash->success(__('The xserv chofer has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv chofer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * View travel history for a driver
     *
     * @param string|null $id Xserv Chofer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viajesHistorial(?string $id = null)
    {
        $this->Authorization->skipAuthorization();
        
        $xservChofere = $this->XservChoferes->get($id, contain: ['Usuarios']);
        
        $this->loadModel('XservAsignaciones');
        
        $query = $this->XservAsignaciones->find()
            ->where(['chofer_id' => $id])
            ->contain(['Reservas', 'Vehiculos'])
            ->order(['created_at' => 'DESC']);
        
        $viajes = $this->paginate($query, ['limit' => 15]);
        
        $this->set(compact('xservChofere', 'viajes'));
    }

    /**
     * View ratings for a driver
     *
     * @param string|null $id Xserv Chofer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function valoraciones(?string $id = null)
    {
        $this->Authorization->skipAuthorization();
        
        $xservChofere = $this->XservChoferes->get($id, contain: ['Usuarios']);
        
        $this->loadModel('XservValoraciones');
        $this->loadModel('XservAsignaciones');
        $this->loadModel('XservReservas');
        
        // Get all assignments for this driver
        $asignacionesIds = $this->XservAsignaciones->find()
            ->where(['chofer_id' => $id])
            ->select(['reserva_id'])
            ->extract('reserva_id')
            ->toList();
        
        // Get ratings for those reservations
        $query = $this->XservValoraciones->find()
            ->whereInList('reserva_id', $asignacionesIds)
            ->contain(['Reservas'])
            ->order(['created_at' => 'DESC']);
        
        $valoraciones = $this->paginate($query, ['limit' => 10]);
        
        // Calculate statistics
        $estadisticas = [
            'total_viajes' => count($asignacionesIds),
            'total_valoraciones' => $this->XservValoraciones->find()
                ->whereInList('reserva_id', $asignacionesIds)
                ->count(),
            'promedio_calificacion' => $this->XservValoraciones->find()
                ->select(['promedio' => $this->XservValoraciones->find()->func('AVG', ['calificacion'])])
                ->whereInList('reserva_id', $asignacionesIds)
                ->first()
                ->promedio ?? 0,
        ];
        
        $this->set(compact('xservChofere', 'valoraciones', 'estadisticas'));
    }

    /**
     * View driver statistics
     *
     * @param string|null $id Xserv Chofer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function estadisticas(?string $id = null)
    {
        $this->Authorization->skipAuthorization();
        
        $xservChofere = $this->XservChoferes->get($id, contain: ['Usuarios']);
        
        $this->loadModel('XservAsignaciones');
        $this->loadModel('XservValoraciones');
        $this->loadModel('XservEjecucionViajes');
        
        // Total trips
        $totalViajes = $this->XservAsignaciones->find()
            ->where(['chofer_id' => $id])
            ->count();
        
        // Completed trips
        $viajuesCompletados = $this->XservAsignaciones->find()
            ->where(['chofer_id' => $id, 'estado_asignacion' => 'finalizada'])
            ->count();
        
        // Current assignments
        $asignacionesActuales = $this->XservAsignaciones->find()
            ->where(['chofer_id' => $id, 'estado_asignacion' => 'en_curso'])
            ->contain(['Reservas', 'Vehiculos'])
            ->all();
        
        // Get ratings info
        $asignacionesIds = $this->XservAsignaciones->find()
            ->where(['chofer_id' => $id])
            ->select(['reserva_id'])
            ->extract('reserva_id')
            ->toList();
        
        $promediCalificacion = $this->XservValoraciones->find()
            ->select(['promedio' => $this->XservValoraciones->find()->func('AVG', ['calificacion'])])
            ->whereInList('reserva_id', $asignacionesIds)
            ->first()
            ->promedio ?? 0;
        
        $totalValoraciones = $this->XservValoraciones->find()
            ->whereInList('reserva_id', $asignacionesIds)
            ->count();
        
        $estadisticas = [
            'total_viajes' => $totalViajes,
            'viajes_completados' => $viajuesCompletados,
            'porcentaje_completacion' => $totalViajes > 0 ? ($viajuesCompletados / $totalViajes) * 100 : 0,
            'promedio_calificacion' => round($promediCalificacion, 1),
            'total_valoraciones' => $totalValoraciones,
            'asignaciones_actuales' => $asignacionesActuales->count(),
        ];
        
        $this->set(compact('xservChofere', 'estadisticas', 'asignacionesActuales'));
    }
}

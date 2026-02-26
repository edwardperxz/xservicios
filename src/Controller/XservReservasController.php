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
    public function initialize(): void
    {
        parent::initialize();
        $this->XservServicios = $this->getTableLocator()->get('XservServicios');
        $this->XservRutas = $this->getTableLocator()->get('XservRutas');
        $this->XservAsignaciones = $this->getTableLocator()->get('XservAsignaciones');


    }

    public function index()
{
    $this->Authorization->skipAuthorization();

    // --- CONSULTA PRINCIPAL ---
    $query = $this->XservReservas->find()
        ->contain([
            'Clientes',
            'Servicios',
            'Rutas',
            'Asignaciones' => [
                'Choferes',
                'Vehiculos'
            ]
        ])
        ->order(['XservReservas.created_at' => 'DESC']);

    // --- FILTROS DESDE GET ---
    $clienteId = $this->request->getQuery('cliente_id');
    $estado = $this->request->getQuery('estado');

    if ($clienteId) {
        $query->where(['cliente_id' => $clienteId]);
    }

    if ($estado) {
        $query->where(['estado' => $estado]);
    }

    // --- PAGINAR ---
    $xservReservas = $this->paginate($query);
    {
        $this->Authorization->skipAuthorization();
        
        $user = $this->Authentication->getIdentity();
        $isAdmin = $user && $user->rol === 'admin';
        
        $query = $this->XservReservas->find()
            ->contain(['Clientes', 'Servicios', 'Rutas']);
        
        $filters = $this->request->getQuery();
        
        if (!empty($filters['estado'])) {
            $query->where(['XservReservas.estado' => $filters['estado']]);
        }
        
        if (!empty($filters['codigo'])) {
            $query->where(['codigo_reserva LIKE' => '%' . $filters['codigo'] . '%']);
        }
        
        $xservReservas = $this->paginate($query);

    // --- DATOS PARA EL PANEL DE FILTROS ---
    $clientes = $this->XservReservas->Clientes->find('list')->toArray();
    $estados = $this->XservReservas->find()
        ->select(['estado'])
        ->distinct(['estado'])
        ->all()
        ->extract('estado')
        ->toList();



    // --- RESPUESTA JSON PARA AJAX ---
    if ($this->request->is('json') || $this->request->getHeader('X-Requested-With') === 'XMLHttpRequest') {
        $this->response = $this->response->withType('application/json');
        return $this->response->withStringBody(json_encode([
            'xservReservas' => $xservReservas->toArray()
        ]));
    }

    // --- PASAR DATOS A LA VISTA ---
    $this->set(compact('xservReservas', 'clientes', 'estados', 'clienteId', 'estado'));
}

        $this->set(compact('xservReservas', 'filters'));
        
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

        $query = $this->XservReservas->find()
            ->contain(['Clientes', 'Servicios', 'Rutas']);

        $filters = $this->request->getQuery();

        if (!empty($filters['estado'])) {
            $query->where(['XservReservas.estado' => $filters['estado']]);
        }

        if (!empty($filters['codigo'])) {
            $query->where(['codigo_reserva LIKE' => '%' . $filters['codigo'] . '%']);
        }

        $xservReservas = $this->paginate($query);

        $this->set(compact('xservReservas', 'filters'));
        $this->render('admin_index');
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

            $data = $this->request->getData();

            // =========================
            // DATOS GENERADOS POR SISTEMA
            // =========================

            $usuario = $this->Authentication->getIdentity();
            $cliente = $this->XservReservas->Clientes
                ->find()
                ->where(['usuario_id' => $usuario->id])
                ->first();
            if (!$cliente) {
                $this->Flash->error('El usuario no tiene cliente asociado.');
                return $this->redirect(['action' => 'index']);
            }
            $data['cliente_id'] = $cliente->id;


            $data['codigo_reserva'] = 'RSV-' . date('Y') . '-' . 
                str_pad((string) rand(1,9999), 4, '0', STR_PAD_LEFT);

            $servicio = $this->XservReservas->Servicios->get($data['servicio_id']);
            $data['precio_pactado'] = $servicio->precio_base;

            $data['itbms_pactado'] = $data['precio_pactado'] * 0.07;

            $data['estado'] = 'pendiente';
            $data['estado_pago'] = 'pendiente';

            // =========================
            // DATOS OPERATIVOS
            // =========================

            $choferId = $data['chofer_id'] ?? null;
            $vehiculoId = $data['vehiculo_id'] ?? null;

            unset($data['chofer_id'], $data['vehiculo_id']);

            // =========================
            // PATCH
            // =========================

            $xservReserva = $this->XservReservas->patchEntity($xservReserva, $data);


            $data = $this->request->getData();

            // =========================
            // DATOS GENERADOS POR SISTEMA
            // =========================

            $usuario = $this->Authentication->getIdentity();

            $cliente = $this->XservReservas->Clientes
                ->find()
                ->where(['usuario_id' => $usuario->id])
                ->first();

            if (!$cliente) {
                $this->Flash->error('El usuario no tiene cliente asociado.');
                return $this->redirect(['action' => 'index']);
            }

            $data['cliente_id'] = $cliente->id;

            $data['codigo_reserva'] = 'RSV-' . date('Y') . '-' .
                str_pad((string) rand(1, 9999), 4, '0', STR_PAD_LEFT);

            $servicio = $this->XservReservas->Servicios->get($data['servicio_id']);
            $data['precio_pactado'] = $servicio->precio_base;
            $data['itbms_pactado'] = $data['precio_pactado'] * 0.07;

            $data['estado'] = 'pendiente';
            $data['estado_pago'] = 'pendiente';

            // =========================
            // DATOS OPERATIVOS
            // =========================

            $choferId = $data['chofer_id'] ?? null;
            $vehiculoId = $data['vehiculo_id'] ?? null;

            unset($data['chofer_id'], $data['vehiculo_id']);

            // =========================
            // PATCH
            // =========================

            $xservReserva = $this->XservReservas->patchEntity($xservReserva, $data);

            if ($this->XservReservas->save($xservReserva)) {

                if ($choferId && $vehiculoId) {

                    $asignacion = $this->XservReservas->Asignaciones->newEmptyEntity();

                    $asignacion->reserva_id = $xservReserva->id;
                    $asignacion->chofer_id = $choferId;
                    $asignacion->vehiculo_id = $vehiculoId;
                    $asignacion->asignado_por_id = $usuario->id;

                    $fechaInicio = $xservReserva->fecha->format('Y-m-d') . ' ' .
                                $xservReserva->hora->format('H:i:s');

                    $asignacion->fecha_inicio_pactada = $fechaInicio;
                    $asignacion->fecha_fin_pactada = date(
                        'Y-m-d H:i:s',
                        strtotime('+2 hours', strtotime($fechaInicio))
                    );

                    $this->XservReservas->Asignaciones->save($asignacion);
                }

                $this->Flash->success('Reserva creada correctamente.');

                // Crear asignación si se enviaron chofer y vehículo
                if ($choferId && $vehiculoId) {

                    $asignacion = $this->XservReservas->Asignaciones->newEmptyEntity();

                    $asignacion->reserva_id = $xservReserva->id;
                    $asignacion->chofer_id = $choferId;
                    $asignacion->vehiculo_id = $vehiculoId;
                    $asignacion->asignado_por_id = $usuario->id;

                    $fechaInicio = $xservReserva->fecha->format('Y-m-d') . ' ' .
                                $xservReserva->hora->format('H:i:s');

                    $asignacion->fecha_inicio_pactada = $fechaInicio;
                    $asignacion->fecha_fin_pactada = date(
                        'Y-m-d H:i:s',
                        strtotime('+2 hours', strtotime($fechaInicio))
                    );

                    $this->XservReservas->Asignaciones->save($asignacion);
                }

                $this->Flash->success('Reserva creada correctamente.');
                return $this->redirect(['action' => 'index']);
            }

            debug($xservReserva->getErrors());
            die();
            $this->Flash->error('Error al guardar la reserva.');

            $this->Flash->error('La reserva no pudo guardarse. Intente nuevamente.');
        }

        // Listas para formulario
        $clientes = $this->XservReservas->Clientes->find('list')->all();
        $servicios = $this->XservReservas->Servicios->find('list')->all();
        $rutas = $this->XservReservas->Rutas->find('list')->all();

        $choferes = $this->XservReservas->Asignaciones->Choferes
            ->find('list')
            ->where(['estado' => 'activo'])
            ->all();

        $vehiculos = $this->XservReservas->Asignaciones->Vehiculos
            ->find('list')
            ->where(['estado_operativo' => 'disponible'])
            ->all();

        $this->set(compact(
            'xservReserva',
            'clientes',
            'servicios',
            'rutas',
            'choferes',
            'vehiculos'
        ));

        // =========================
        // LISTAS PARA FORMULARIO
        // =========================

        $clientes = $this->XservReservas->Clientes->find('list', limit: 200)->all();
        $servicios = $this->XservReservas->Servicios->find('list', limit: 200)->all();
        $rutas = $this->XservReservas->Rutas->find('list', limit: 200)->all();

        $choferes = $this->XservReservas->Asignaciones->Choferes
            ->find('list')
            ->where(['estado' => 'activo'])
            ->all();

        $vehiculos = $this->XservReservas->Asignaciones->Vehiculos
            ->find('list')
            ->where(['estado_operativo' => 'disponible'])
            ->all();

        $this->set(compact(
            'xservReserva',
            'clientes',
            'servicios',
            'rutas',
            'choferes',
            'vehiculos'
        ));
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

    /**
     * Get user's reservations as JSON
     * @return \Cake\Http\Response Returns JSON with user's reservations grouped by category
     */
    public function myReservations()
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['get']);
        
        $user = $this->Authentication->getIdentity();
        
        // Si no hay usuario autenticado, retornar error
        if (!$user) {
            $this->response = $this->response->withStatus(401)->withType('application/json');
            return $this->response->withStringBody(json_encode([
                'success' => false,
                'error' => 'Unauthorized'
            ]));
        }

        try {
            // Obtener todas las reservas del usuario
            $query = $this->XservReservas->find()
                ->contain(['Clientes', 'Servicios', 'Rutas'])
                ->where(['XservReservas.cliente_id' => $user->id])
                ->orderBy(['XservReservas.fecha' => 'DESC']);

            $allReservas = $query->all();
            
            // Categorizar reservas
            $categorized = [
                'proximos' => [],      // Reservas futuras (no completada ni cancelada)
                'completadas' => [],   // Reservas completadas
                'canceladas' => []     // Reservas canceladas
            ];

            foreach ($allReservas as $reserva) {
                $estado = strtolower($reserva->estado);
                $reservaArray = [
                    'id' => $reserva->id,
                    'codigo_reserva' => $reserva->codigo_reserva,
                    'fecha' => $reserva->fecha ? $reserva->fecha->format('Y-m-d') : null,
                    'hora' => $reserva->hora ? (is_string($reserva->hora) ? $reserva->hora : $reserva->hora->format('H:i:s')) : null,
                    'pasajeros' => $reserva->pasajeros,
                    'precio_pactado' => $reserva->precio_pactado,
                    'itbms_pactado' => $reserva->itbms_pactado,
                    'punto_recogida' => $reserva->punto_recogida,
                    'punto_destino' => $reserva->punto_destino,
                    'observaciones' => $reserva->observaciones,
                    'estado' => $reserva->estado,
                    'estado_pago' => $reserva->estado_pago,
                    'servicio' => $reserva->servicio ? [
                        'id' => $reserva->servicio->id,
                        'nombre' => $reserva->servicio->nombre
                    ] : null
                ];
                
                if ($estado === 'cancelada') {
                    $categorized['canceladas'][] = $reservaArray;
                } elseif ($estado === 'completada') {
                    $categorized['completadas'][] = $reservaArray;
                } else {
                    $categorized['proximos'][] = $reservaArray;
                }
            }

            $this->response = $this->response->withType('application/json');
            return $this->response->withStringBody(json_encode([
                'success' => true,
                'reservations' => $categorized
            ]));
        } catch (\Exception $e) {
            $this->response = $this->response->withStatus(500)->withType('application/json');
            return $this->response->withStringBody(json_encode([
                'success' => false,
                'error' => 'Error loading reservations',
                'message' => $e->getMessage()
            ]));
        }
    }
}

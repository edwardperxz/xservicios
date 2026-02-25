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
    public function index()
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

        // Si es una petición JSON/AJAX
        if ($this->request->is('json') || $this->request->getHeader('X-Requested-With') === 'XMLHttpRequest') {
            $this->response = $this->response->withType('application/json');
            return $this->response->withStringBody(json_encode([
                'xservReservas' => $xservReservas->toArray()
            ]));
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

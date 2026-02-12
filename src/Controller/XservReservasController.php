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
        
        $query = $this->XservReservas->find()
            ->contain(['XservClientes', 'XservServicios', 'XservRutas', 'XservChoferes', 'XservVehiculos']);
        $xservReservas = $this->paginate($query);

        // Si es una petición JSON/AJAX
        if ($this->request->is('json') || $this->request->getHeader('X-Requested-With') === 'XMLHttpRequest') {
            $this->response = $this->response->withType('application/json');
            return $this->response->withStringBody(json_encode([
                'xservReservas' => $xservReservas->toArray()
            ]));
        }

        $this->set(compact('xservReservas'));
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

    public function reservations()
    {
        $this->Authorization->skipAuthorization();
        $user = $this->Authentication->getIdentity();
        if (!$user) {
            $this->Flash->error(__('Debes iniciar sesión para reservar.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $reserva = $this->XservReservas->newEmptyEntity();

        if ($this->request->is('post')) {

            $reserva = $this->XservReservas->patchEntity($reserva, $this->request->getData());

            $reserva->cliente_id = $user->cliente_id;

            $ruta = $this->XservRutas->get($reserva->ruta_id);
            $servicio = $this->XservServicios->get($reserva->servicio_id);

            $reserva->precio_pactado = $ruta->precio_base + $servicio->precio_base;
            $reserva->itbms_pactado = $reserva->precio_pactado * 0.07;

            $reserva->estado = 'pendiente';
            $reserva->estado_pago = 'pendiente';

            if ($this->XservReservas->save($reserva)) {

                $reserva->codigo_reserva = 'XSERV-' . str_pad($reserva->id, 4, '0', STR_PAD_LEFT);
                $this->XservReservas->save($reserva);

                $this->asignarChoferVehiculo($reserva);

                $this->Flash->success(__('Tu reserva ha sido creada correctamente.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('No se pudo guardar la reserva. Por favor, intenta nuevamente.'));
            }
        }

        $servicios = $this->XservServicios->find('list', ['limit' => 200])->toArray();
        $rutas = $this->XservRutas->find('list', ['limit' => 200, 'valueField' => 'id'])->toArray();

        $this->set(compact('reserva', 'servicios', 'rutas'));
    }

    /**
     * Método privado para asignar automáticamente chofer y vehículo disponible
     */
    private function asignarChoferVehiculo($reserva)
    {
        $choferesDisponibles = $this->XservAsignaciones->buscarChoferesDisponibles($reserva->fecha, $reserva->hora);
        $vehiculosDisponibles = $this->XservAsignaciones->buscarVehiculosDisponibles($reserva->fecha, $reserva->hora, $reserva->pasajeros);

        if (!empty($choferesDisponibles) && !empty($vehiculosDisponibles)) {
            $asignacion = $this->XservAsignaciones->newEmptyEntity();
            $asignacion->reserva_id = $reserva->id;
            $asignacion->chofer_id = $choferesDisponibles[0]; // toma el primero disponible
            $asignacion->vehiculo_id = $vehiculosDisponibles[0]; // toma el primero disponible
            $asignacion->asignado_por_id = $this->Authentication->getIdentity()->id;
            $asignacion->fecha_inicio_pactada = $reserva->fecha . ' ' . $reserva->hora;
            $asignacion->fecha_fin_pactada = date('Y-m-d H:i:s', strtotime($reserva->fecha . ' ' . $reserva->hora . ' +2 hours')); // ejemplo 2 horas
            $asignacion->estado_asignacion = 'programada';

            $this->XservAsignaciones->save($asignacion);
        }
        // Si no hay recursos, se deja para asignación manual por operador
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
}

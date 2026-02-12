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

        $user = $this->Authentication->getIdentity()->getOriginalData();
        if (!$user) {
            $this->Flash->error(__('Debes iniciar sesión para reservar.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $xservReserva = $this->XservReservas->newEmptyEntity();

        if ($this->request->is('post')) {

            $xservReserva = $this->XservReservas->patchEntity(
                $xservReserva,
                $this->request->getData()
            );

            // validar pasajeros
            if ($xservReserva->pasajeros > 30) {
                $this->Flash->error('El máximo permitido es 30 pasajeros.');
                return;
            }

            // 🔥 OBTENER CLIENTE REAL (ARREGLO PRINCIPAL)
            $cliente = $this->fetchTable('XservClientes')
                ->find()
                ->where(['usuario_id' => $user->id])
                ->first();

            if (!$cliente) {
                $this->Flash->error('No tienes perfil de cliente.');
                return;
            }

            $xservReserva->cliente_id = $cliente->id;

            // datos automáticos
            $xservReserva->estado = 'pendiente';
            $xservReserva->estado_pago = 'pendiente';

            // validar datos necesarios
            if (!$xservReserva->ruta_id || !$xservReserva->servicio_id) {
                $this->Flash->error('Debes seleccionar ruta y servicio.');
                return;
            }

            // cálculo precio
            $ruta = $this->XservRutas->get($xservReserva->ruta_id);
            $servicio = $this->XservServicios->get($xservReserva->servicio_id);

            $xservReserva->precio_pactado =
                $ruta->precio_base + $servicio->precio_base;

            $xservReserva->itbms_pactado =
                $xservReserva->precio_pactado * 0.07;

            $xservReserva->codigo_reserva =
                'XSERV-' . strtoupper(substr(uniqid(), -6));

            if ($this->XservReservas->save($xservReserva)) {
                $this->asignarChoferVehiculo($xservReserva);
                $this->Flash->success(__('Tu reserva ha sido creada correctamente.'));
                return $this->redirect(['action' => 'reservations']);
            }

            $this->Flash->error(__('No se pudo guardar la reserva.'));
        }

        $servicios = $this->XservServicios->find('list')->toArray();
        $rutas = $this->XservRutas->find('list')->toArray();

        $this->set(compact('xservReserva', 'servicios', 'rutas'));
    }

    private function asignarChoferVehiculo($reserva)
    {
        // ejemplo simple — luego mejoras la lógica
        $chofer = $this->fetchTable('XservChoferes')
            ->find()
            ->first();

        $vehiculo = $this->fetchTable('XservVehiculos')
            ->find()
            ->first();

        if ($chofer && $vehiculo) {

            $reserva->chofer_id = $chofer->id;
            $reserva->vehiculo_id = $vehiculo->id;

            $this->XservReservas->save($reserva);
        }
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

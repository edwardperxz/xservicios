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
            ->contain([
                'Clientes',
                'Servicios',
                'Rutas',
                'Asignaciones' => [
                    'Choferes',
                    'Vehiculos'
                ]
            ]);
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
        $reserva = $this->XservReservas->newEmptyEntity();

        if ($this->request->is('post')) {

            $data = $this->request->getData();

            // Extraemos los datos operativos
            $choferId = $data['chofer_id'];
            $vehiculoId = $data['vehiculo_id'];

            // Quitamos esos campos antes de guardar reserva
            unset($data['chofer_id'], $data['vehiculo_id']);

            $reserva = $this->XservReservas->patchEntity($reserva, $data);

            if ($this->XservReservas->save($reserva)) {

                // Ahora creamos la asignación
                $asignacion = $this->XservReservas->Asignaciones->newEmptyEntity();

                $asignacion->reserva_id = $reserva->id;
                $asignacion->chofer_id = $choferId;
                $asignacion->vehiculo_id = $vehiculoId;
                $asignacion->asignado_por_id = $this->Authentication->getIdentity()->id;
                $asignacion->fecha_inicio_pactada = $reserva->fecha . ' ' . $reserva->hora;
                $asignacion->fecha_fin_pactada = date('Y-m-d H:i:s', strtotime('+2 hours', strtotime($asignacion->fecha_inicio_pactada)));

                $this->XservReservas->Asignaciones->save($asignacion);

                $this->Flash->success('Reserva creada correctamente.');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Error al guardar la reserva.');
        }

        $choferes = $this->XservReservas->Asignaciones->Choferes->find('list')
            ->where(['estado' => 'activo']);

        $vehiculos = $this->XservReservas->Asignaciones->Vehiculos->find('list')
            ->where(['estado_operativo' => 'disponible']);

        $this->set(compact('reserva', 'choferes', 'vehiculos'));
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

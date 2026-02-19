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
                return $this->redirect(['action' => 'index']);
            }

            debug($xservReserva->getErrors());
            die();
            $this->Flash->error('Error al guardar la reserva.');
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

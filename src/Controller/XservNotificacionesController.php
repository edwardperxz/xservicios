<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservNotificaciones Controller
 *
 * @property \App\Model\Table\XservNotificacionesTable $XservNotificaciones
 */
class XservNotificacionesController extends AppController
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

        $query = $this->XservNotificaciones->find()
            ->contain(['Usuarios', 'Clientes', 'Reservas']);

        if (!empty($filters['estado_envio'])) {
            $query->where(['estado_envio' => $filters['estado_envio']]);
        }

        if (!empty($filters['medio'])) {
            $query->where(['medio' => $filters['medio']]);
        }

        if (!empty($filters['tipo_notificacion'])) {
            $query->where(['tipo_notificacion' => $filters['tipo_notificacion']]);
        }

        $xservNotificaciones = $this->paginate($query);

        // Obtener valores distinctos para filtros
        $estadosEnvio = $this->XservNotificaciones->find()
            ->select(['estado_envio'])
            ->distinct(['estado_envio'])
            ->where(['estado_envio IS NOT' => null])
            ->order(['estado_envio' => 'ASC'])
            ->all()
            ->extract('estado_envio')
            ->toList();

        $medios = $this->XservNotificaciones->find()
            ->select(['medio'])
            ->distinct(['medio'])
            ->where(['medio IS NOT' => null])
            ->order(['medio' => 'ASC'])
            ->all()
            ->extract('medio')
            ->toList();

        $tiposNotificacion = $this->XservNotificaciones->find()
            ->select(['tipo_notificacion'])
            ->distinct(['tipo_notificacion'])
            ->where(['tipo_notificacion IS NOT' => null])
            ->order(['tipo_notificacion' => 'ASC'])
            ->all()
            ->extract('tipo_notificacion')
            ->toList();

        $this->set(compact('xservNotificaciones', 'filters', 'estadosEnvio', 'medios', 'tiposNotificacion'));

        if ($isAdmin) {
            $this->render('admin_index');
        }
    }

    /**
     * View method
     *
    * @param string|null $id Xserv Notificacion id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $xservNotificacione = $this->XservNotificaciones->get($id, contain: ['Usuarios', 'Clientes', 'Reservas']);
        $this->set(compact('xservNotificacione'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $xservNotificacione = $this->XservNotificaciones->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservNotificacione = $this->XservNotificaciones->patchEntity($xservNotificacione, $this->request->getData());
            if ($this->XservNotificaciones->save($xservNotificacione)) {
                $this->Flash->success(__('The xserv notificacion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv notificacion could not be saved. Please, try again.'));
        }
        $usuarios = $this->XservNotificaciones->Usuarios->find('list', [
            'keyField' => 'id',
            'valueField' => function($usuario) {
                return $usuario->username . ' - ' . $usuario->nombre;
            }
        ])->order(['username' => 'ASC'])->all();
        
        $clientes = $this->XservNotificaciones->Clientes->find('list', [
            'keyField' => 'id',
            'valueField' => function($cliente) {
                return $cliente->usuario->nombre ?? 'Sin nombre';
            }
        ])->contain(['XservUsuarios'])->order(['XservUsuarios.nombre' => 'ASC'])->all();
        
        $reservas = $this->XservNotificaciones->Reservas->find('list', [
            'keyField' => 'id',
            'valueField' => 'codigo_reserva'
        ])->order(['codigo_reserva' => 'ASC'])->all();
        
        $this->set(compact('xservNotificacione', 'usuarios', 'clientes', 'reservas'));
    }

    /**
     * Edit method
     *
    * @param string|null $id Xserv Notificacion id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $xservNotificacione = $this->XservNotificaciones->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservNotificacione = $this->XservNotificaciones->patchEntity($xservNotificacione, $this->request->getData());
            if ($this->XservNotificaciones->save($xservNotificacione)) {
                $this->Flash->success(__('The xserv notificacion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv notificacion could not be saved. Please, try again.'));
        }
        $usuarios = $this->XservNotificaciones->Usuarios->find('list', [
            'keyField' => 'id',
            'valueField' => function($usuario) {
                return $usuario->username . ' - ' . $usuario->nombre;
            }
        ])->order(['username' => 'ASC'])->all();
        
        $clientes = $this->XservNotificaciones->Clientes->find('list', [
            'keyField' => 'id',
            'valueField' => function($cliente) {
                return $cliente->usuario->nombre ?? 'Sin nombre';
            }
        ])->contain(['XservUsuarios'])->order(['XservUsuarios.nombre' => 'ASC'])->all();
        
        $reservas = $this->XservNotificaciones->Reservas->find('list', [
            'keyField' => 'id',
            'valueField' => 'codigo_reserva'
        ])->order(['codigo_reserva' => 'ASC'])->all();
        
        $this->set(compact('xservNotificacione', 'usuarios', 'clientes', 'reservas'));
    }

    /**
     * Delete method
     *
    * @param string|null $id Xserv Notificacion id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $xservNotificacione = $this->XservNotificaciones->get($id);
        if ($this->XservNotificaciones->delete($xservNotificacione)) {
            $this->Flash->success(__('The xserv notificacion has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv notificacion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

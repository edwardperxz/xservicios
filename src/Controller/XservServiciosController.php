<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservServicios Controller
 *
 * @property \App\Model\Table\XservServiciosTable $XservServicios
 */
class XservServiciosController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['index', 'view']);
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

        $query = $this->XservServicios->find();
        
        $filters = $this->request->getQuery();
        
        // Para frontend público: mostrar solo servicios activos por defecto
        if (!$isAdmin) {
            $query->where(['estado' => 'activo']);
        }
        
        if (!empty($filters['estado'])) {
            $query->where(['estado' => $filters['estado']]);
        }
        
        if (!empty($filters['nombre'])) {
            $query->where(['nombre LIKE' => '%' . $filters['nombre'] . '%']);
        }
        
        // Configurar paginación: 12 items por página
        $this->paginate = [
            'limit' => 12,
            'order' => ['XservServicios.created_at' => 'DESC']
        ];
        
        $xservServicios = $this->paginate($query);

        if ($this->request->is('json') || $this->request->getHeader('X-Requested-With') === 'XMLHttpRequest') {
            $this->response = $this->response->withType('application/json');
            
            // Obtener información de paginación
            $paging = $this->request->getAttribute('paging');
            $pagingInfo = $paging['XservServicios'] ?? [];
            
            return $this->response->withStringBody(json_encode([
                'xservServicios' => $xservServicios->toArray(),
                'pagination' => [
                    'page' => $pagingInfo['page'] ?? 1,
                    'pageCount' => $pagingInfo['pageCount'] ?? 1,
                    'total' => $pagingInfo['count'] ?? 0,
                    'limit' => $pagingInfo['perPage'] ?? 12,
                    'hasPrevious' => !empty($pagingInfo['prevPage']),
                    'hasNext' => !empty($pagingInfo['nextPage']),
                ]
            ]));
        }

        $this->set(compact('xservServicios', 'filters'));
        
        if ($isAdmin) {
            $this->render('admin_index');
        }
    }

    /**
     * View method
     *
     * @param string|null $id Xserv Servicio id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $this->Authorization->skipAuthorization();

        $xservServicio = $this->XservServicios->get($id, contain: []);
        if ($this->request->is('json') || $this->request->getHeader('X-Requested-With') === 'XMLHttpRequest') {
            $this->response = $this->response->withType('application/json');
            return $this->response->withStringBody(json_encode([
                'xservServicio' => [
                    'id' => $xservServicio->id,
                    'nombre' => $xservServicio->nombre,
                    'estado' => $xservServicio->estado,
                    'precio_base' => $xservServicio->precio_base,
                    'variantes' => $xservServicio->variantes,
                ],
            ]));
        }

        $this->set(compact('xservServicio'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $xservServicio = $this->XservServicios->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservServicio = $this->XservServicios->patchEntity($xservServicio, $this->request->getData());
            if ($this->XservServicios->save($xservServicio)) {
                $this->Flash->success(__('The xserv servicio has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv servicio could not be saved. Please, try again.'));
        }
        $this->set(compact('xservServicio'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xserv Servicio id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $xservServicio = $this->XservServicios->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservServicio = $this->XservServicios->patchEntity($xservServicio, $this->request->getData());
            if ($this->XservServicios->save($xservServicio)) {
                $this->Flash->success(__('The xserv servicio has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv servicio could not be saved. Please, try again.'));
        }
        $this->set(compact('xservServicio'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xserv Servicio id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $xservServicio = $this->XservServicios->get($id);
        if ($this->XservServicios->delete($xservServicio)) {
            $this->Flash->success(__('The xserv servicio has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv servicio could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservDestinos Controller
 *
 * @property \App\Model\Table\XservDestinosTable $XservDestinos
 */
class XservDestinosController extends AppController
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

        $query = $this->XservDestinos->find()
            ->contain(['Ubicacions']);

        if ($filters['es_popular'] ?? '' !== '') {
            $query->where(['es_popular' => (int)$filters['es_popular']]);
        }

        if (!empty($filters['ubicacion_id'])) {
            $query->where(['ubicacion_id' => $filters['ubicacion_id']]);
        }

        $xservDestinos = $this->paginate($query);

        // Obtener valores distinctos para filtros
        $ubicaciones = $this->XservDestinos->Ubicacions->find('list', ['keyField' => 'id', 'valueField' => 'nombre'])
            ->order(['nombre' => 'ASC'])
            ->toArray();

        $this->set(compact('xservDestinos', 'filters', 'ubicaciones'));

        if ($isAdmin) {
            $this->render('admin_index');
        }
    }

    /**
     * View method
     *
     * @param string|null $id Xserv Destino id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $xservDestino = $this->XservDestinos->get($id, contain: ['Ubicacions']);
        $this->set(compact('xservDestino'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $xservDestino = $this->XservDestinos->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservDestino = $this->XservDestinos->patchEntity($xservDestino, $this->request->getData());
            if ($this->XservDestinos->save($xservDestino)) {
                $this->Flash->success(__('The xserv destino has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv destino could not be saved. Please, try again.'));
        }
        $ubicacions = $this->XservDestinos->Ubicacions->find('list', [
            'keyField' => 'id',
            'valueField' => 'nombre'
        ])->order(['nombre' => 'ASC'])->all();
        $this->set(compact('xservDestino', 'ubicacions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xserv Destino id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $xservDestino = $this->XservDestinos->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservDestino = $this->XservDestinos->patchEntity($xservDestino, $this->request->getData());
            if ($this->XservDestinos->save($xservDestino)) {
                $this->Flash->success(__('The xserv destino has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv destino could not be saved. Please, try again.'));
        }
        $ubicacions = $this->XservDestinos->Ubicacions->find('list', [
            'keyField' => 'id',
            'valueField' => 'nombre'
        ])->order(['nombre' => 'ASC'])->all();
        $this->set(compact('xservDestino', 'ubicacions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xserv Destino id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $xservDestino = $this->XservDestinos->get($id);
        if ($this->XservDestinos->delete($xservDestino)) {
            $this->Flash->success(__('The xserv destino has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv destino could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

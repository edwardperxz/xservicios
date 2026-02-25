<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservUbicaciones Controller
 *
 * @property \App\Model\Table\XservUbicacionesTable $XservUbicaciones
 */
class XservUbicacionesController extends AppController
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

        $query = $this->XservUbicaciones->find();

        if (!empty($filters['nombre'])) {
            $query->where(['nombre LIKE' => '%' . $filters['nombre'] . '%']);
        }

        if (!empty($filters['EN_PROVINCIAS'])) {
            $query->where(['EN_PROVINCIAS' => $filters['EN_PROVINCIAS']]);
        }

        $xservUbicaciones = $this->paginate($query);

        // Obtener valores distinctos para filtros
        $provincias = $this->XservUbicaciones->find()
            ->select(['EN_PROVINCIAS'])
            ->distinct(['EN_PROVINCIAS'])
            ->where(['EN_PROVINCIAS IS NOT' => null])
            ->order(['EN_PROVINCIAS' => 'ASC'])
            ->all()
            ->extract('EN_PROVINCIAS')
            ->toList();

        $this->set(compact('xservUbicaciones', 'filters', 'provincias'));

        if ($isAdmin) {
            $this->render('admin_index');
        }
    }

    /**
     * View method
     *
    * @param string|null $id Xserv Ubicacion id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $xservUbicacione = $this->XservUbicaciones->get($id, contain: []);
        $this->set(compact('xservUbicacione'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $xservUbicacione = $this->XservUbicaciones->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservUbicacione = $this->XservUbicaciones->patchEntity($xservUbicacione, $this->request->getData());
            if ($this->XservUbicaciones->save($xservUbicacione)) {
                $this->Flash->success(__('The xserv ubicacion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv ubicacion could not be saved. Please, try again.'));
        }
        $this->set(compact('xservUbicacione'));
    }

    /**
     * Edit method
     *
    * @param string|null $id Xserv Ubicacion id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $xservUbicacione = $this->XservUbicaciones->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservUbicacione = $this->XservUbicaciones->patchEntity($xservUbicacione, $this->request->getData());
            if ($this->XservUbicaciones->save($xservUbicacione)) {
                $this->Flash->success(__('The xserv ubicacion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv ubicacion could not be saved. Please, try again.'));
        }
        $this->set(compact('xservUbicacione'));
    }

    /**
     * Delete method
     *
    * @param string|null $id Xserv Ubicacion id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $xservUbicacione = $this->XservUbicaciones->get($id);
        if ($this->XservUbicaciones->delete($xservUbicacione)) {
            $this->Flash->success(__('The xserv ubicacion has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv ubicacion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

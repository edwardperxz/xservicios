<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservConfiguraciones Controller
 *
 * @property \App\Model\Table\XservConfiguracionesTable $XservConfiguraciones
 */
class XservConfiguracionesController extends AppController
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

        $query = $this->XservConfiguraciones->find();

        if (!empty($filters['grupo'])) {
            $query->where(['grupo' => $filters['grupo']]);
        }

        if (!empty($filters['clave'])) {
            $query->where(['clave LIKE' => '%' . $filters['clave'] . '%']);
        }

        if ($filters['editable_por_admin'] ?? '' !== '') {
            $query->where(['editable_por_admin' => (int)$filters['editable_por_admin']]);
        }

        $xservConfiguraciones = $this->paginate($query);

        // Obtener valores distinctos para filtros
        $grupos = $this->XservConfiguraciones->find()
            ->select(['grupo'])
            ->distinct(['grupo'])
            ->where(['grupo IS NOT' => null])
            ->order(['grupo' => 'ASC'])
            ->all()
            ->extract('grupo')
            ->toList();

        $this->set(compact('xservConfiguraciones', 'filters', 'grupos'));

        if ($isAdmin) {
            $this->render('admin_index');
        }
    }

    /**
     * View method
     *
    * @param string|null $id Xserv Configuracion id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $xservConfiguracione = $this->XservConfiguraciones->get($id, contain: []);
        $this->set(compact('xservConfiguracione'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $xservConfiguracione = $this->XservConfiguraciones->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservConfiguracione = $this->XservConfiguraciones->patchEntity($xservConfiguracione, $this->request->getData());
            if ($this->XservConfiguraciones->save($xservConfiguracione)) {
                $this->Flash->success(__('The xserv configuracion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv configuracion could not be saved. Please, try again.'));
        }
        $this->set(compact('xservConfiguracione'));
    }

    /**
     * Edit method
     *
    * @param string|null $id Xserv Configuracion id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $xservConfiguracione = $this->XservConfiguraciones->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservConfiguracione = $this->XservConfiguraciones->patchEntity($xservConfiguracione, $this->request->getData());
            if ($this->XservConfiguraciones->save($xservConfiguracione)) {
                $this->Flash->success(__('The xserv configuracion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv configuracion could not be saved. Please, try again.'));
        }
        $this->set(compact('xservConfiguracione'));
    }

    /**
     * Delete method
     *
    * @param string|null $id Xserv Configuracion id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $xservConfiguracione = $this->XservConfiguraciones->get($id);
        if ($this->XservConfiguraciones->delete($xservConfiguracione)) {
            $this->Flash->success(__('The xserv configuracion has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv configuracion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

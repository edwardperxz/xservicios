<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservRutas Controller
 *
 * @property \App\Model\Table\XservRutasTable $XservRutas
 */
class XservRutasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->XservRutas->find()
            ->contain(['Origens', 'Destinos']);
        $xservRutas = $this->paginate($query);

        $this->set(compact('xservRutas'));
    }

    /**
     * View method
     *
     * @param string|null $id Xserv Ruta id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $xservRuta = $this->XservRutas->get($id, contain: ['Origens', 'Destinos']);
        $this->set(compact('xservRuta'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $xservRuta = $this->XservRutas->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservRuta = $this->XservRutas->patchEntity($xservRuta, $this->request->getData());
            if ($this->XservRutas->save($xservRuta)) {
                $this->Flash->success(__('The xserv ruta has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv ruta could not be saved. Please, try again.'));
        }
        $origens = $this->XservRutas->Origens->find('list', [
            'keyField' => 'id',
            'valueField' => 'nombre'
        ])->order(['nombre' => 'ASC'])->all();
        
        $destinos = $this->XservRutas->Destinos->find('list', [
            'keyField' => 'id',
            'valueField' => 'nombre'
        ])->order(['nombre' => 'ASC'])->all();
        
        $this->set(compact('xservRuta', 'origens', 'destinos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xserv Ruta id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $xservRuta = $this->XservRutas->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservRuta = $this->XservRutas->patchEntity($xservRuta, $this->request->getData());
            if ($this->XservRutas->save($xservRuta)) {
                $this->Flash->success(__('The xserv ruta has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv ruta could not be saved. Please, try again.'));
        }
        $origens = $this->XservRutas->Origens->find('list', [
            'keyField' => 'id',
            'valueField' => 'nombre'
        ])->order(['nombre' => 'ASC'])->all();
        
        $destinos = $this->XservRutas->Destinos->find('list', [
            'keyField' => 'id',
            'valueField' => 'nombre'
        ])->order(['nombre' => 'ASC'])->all();
        
        $this->set(compact('xservRuta', 'origens', 'destinos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xserv Ruta id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $xservRuta = $this->XservRutas->get($id);
        if ($this->XservRutas->delete($xservRuta)) {
            $this->Flash->success(__('The xserv ruta has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv ruta could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

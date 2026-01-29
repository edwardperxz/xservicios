<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

/**
 * XservUsuarios Controller
 *
 * @property \App\Model\Table\XservUsuariosTable $XservUsuarios
 */
class XservUsuariosController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        //login NO requiere autenticación
        $this->Authentication->addUnauthenticatedActions([
            'login',
            'register',
            ]);
    }

    public function login()
    {
        //login NO requiere autorización
        $this->Authorization->skipAuthorization();

        $result = $this->Authentication->getResult();

        if ($result->isValid()) {
            return $this->redirect('/');
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Usuario o contraseña incorrectos');
        }
    }

    public function logout()
    {
        $this->Authorization->skipAuthorization();

        $this->Authentication->logout();

        return $this->redirect(['action' => 'login']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->XservUsuarios->find();
        $xservUsuarios = $this->paginate($query);

        $this->set(compact('xservUsuarios'));
    }

    /**
     * View method
     *
     * @param string|null $id Xserv Usuario id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $xservUsuario = $this->XservUsuarios->get($id, contain: []);
        $this->set(compact('xservUsuario'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $xservUsuario = $this->XservUsuarios->newEmptyEntity();
        if ($this->request->is('post')) {
            $xservUsuario = $this->XservUsuarios->patchEntity($xservUsuario, $this->request->getData());
            if ($this->XservUsuarios->save($xservUsuario)) {
                $this->Flash->success(__('The xserv usuario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv usuario could not be saved. Please, try again.'));
        }
        $this->set(compact('xservUsuario'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xserv Usuario id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $xservUsuario = $this->XservUsuarios->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xservUsuario = $this->XservUsuarios->patchEntity($xservUsuario, $this->request->getData());
            if ($this->XservUsuarios->save($xservUsuario)) {
                $this->Flash->success(__('The xserv usuario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv usuario could not be saved. Please, try again.'));
        }
        $this->set(compact('xservUsuario'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xserv Usuario id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $xservUsuario = $this->XservUsuarios->get($id);
        if ($this->XservUsuarios->delete($xservUsuario)) {
            $this->Flash->success(__('The xserv usuario has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv usuario could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function register()
    {
        $this->Authorization->skipAuthorization();

        $usuario = $this->XservUsuarios->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // valores por defecto obligatorios
            $data['rol'] = 'operador';
            $data['estado'] = 'activo';

            $usuario = $this->XservUsuarios->newEntity($data);

            if ($this->XservUsuarios->save($usuario)) {
                $this->Flash->success('Cuenta creada correctamente');
                return $this->redirect(['action' => 'login']);
            }

            // DEBUG ÚTIL (déjalo mientras pruebas)
            debug($usuario->getErrors());
            $this->Flash->error('No se pudo crear la cuenta');
        }

        $this->set(compact('usuario'));
    }



}

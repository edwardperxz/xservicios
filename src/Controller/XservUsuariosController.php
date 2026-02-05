<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Http\Response;

/**
 * XservUsuarios Controller
 *
 * @property \App\Model\Table\XservUsuariosTable $XservUsuarios
 */
class XservUsuariosController extends AppController
{
    /**
     * Before filter callback
     *
     * @param \Cake\Event\EventInterface $event The event
     * @return void
     */
    public function beforeFilter(EventInterface $event): void
    {
        parent::beforeFilter($event);

        //login NO requiere autenticación
        $this->Authentication->addUnauthenticatedActions([
            'login',
            'register',
        ]);
    }

    /**
     * Login method
     *
     * @return \Cake\Http\Response|null Redirects on successful login, renders view otherwise.
     */
    public function login(): ?Response
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

        return null;
    }

    /**
     * Logout method
     *
     * @return \Cake\Http\Response Redirects to login page.
     */
    public function logout(): Response
    {
        $this->Authorization->skipAuthorization();

        $this->Authentication->logout();

        return $this->redirect(['action' => 'login']);
    }


    public function profile()
    {
        $this->Authorization->skipAuthorization();

        $user = $this->Authentication->getIdentity();
        if (!$user) {
            $this->Flash->error('Debe iniciar sesión para ver el perfil');
            return $this->redirect(['action' => 'login']);
        }

        // Solo redirigir si es chofer
        if ($user->rol === 'chofer') {
            $chofer = $this->XservUsuarios->XservChoferes
                ->find()
                ->where(['usuario_id' => $user->id])
                ->first();

            if ($chofer) {
                // Redirige al view del chofer
                return $this->redirect([
                    'controller' => 'XservChoferes',
                    'action' => 'view',
                    $chofer->id
                ]);
            }
        }

        // Para admin u operador, puedes mostrar profile normal
        $this->set(compact('user'));
    }



    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $query = $this->XservUsuarios->find();

        $filters = $this->request->getQuery();

        if (!empty($filters['rol'])) {
            $query->where(['rol' => $filters['rol']]);
        }

        if (!empty($filters['estado'])) {
            $query->where(['estado' => $filters['estado']]);
        }

        if (!empty($filters['username'])) {
            $query->where(['username LIKE' => '%' . $filters['username'] . '%']);
        }

        $xservUsuarios = $this->paginate($query);

        $this->set(compact('xservUsuarios', 'filters'));
    }



    /**
     * View method
     *
     * @param string|null $id Xserv Usuario id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $this->Authorization->skipAuthorization();
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

            // Forzamos el rol si no viene en el form para evitar inyecciones de privilegios
            $xservUsuario->rol = 'cliente';
            $xservUsuario->estado = 'activo';

            if ($this->XservUsuarios->save($xservUsuario)) {
                $this->Flash->success(__('Cuenta creada con éxito. Ya puedes iniciar sesión.'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('No se pudo crear la cuenta. Por favor, intente de nuevo.'));
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
    public function edit(?string $id = null)
    {
        
        $this->Authorization->skipAuthorization();
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
    public function delete(?string $id = null)
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

    /**
     * Register method
     *
     * @return \Cake\Http\Response|null Redirects on successful registration, renders view otherwise.
     */
    public function register(): ?Response
    {
        $this->Authorization->skipAuthorization();

        $xservUsuario = $this->XservUsuarios->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // valores por defecto obligatorios
            $data['rol'] = 'operador';
            $data['estado'] = 'activo';

            $xservUsuario = $this->XservUsuarios->newEntity($data);

            if ($this->XservUsuarios->save($xservUsuario)) {
                $this->Flash->success('Cuenta creada correctamente');

                return $this->redirect(['action' => 'login']);
            }

            // DEBUG ÚTIL (déjalo mientras pruebas)
            debug($xservUsuario->getErrors());
            $this->Flash->error('No se pudo crear la cuenta');
        }

        $this->set(compact('xservUsuario'));

        return null;
    }

    public function changePassword()
    {
        $this->Authorization->skipAuthorization(); // temporal si no quieres autorización complicada

        $user = $this->Authentication->getIdentity();
        if (!$user) {
            $this->Flash->error('Debe iniciar sesión para cambiar la contraseña.');
            return $this->redirect(['action' => 'login']);
        }

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();

            $hasher = new \Authentication\PasswordHasher\DefaultPasswordHasher();

            // Verificar contraseña actual
            if (!$hasher->check($data['current_password'], $user->password)) {
                $this->Flash->error('La contraseña actual es incorrecta.');
            } elseif ($data['new_password'] !== $data['confirm_password']) {
                $this->Flash->error('La nueva contraseña y la confirmación no coinciden.');
            } else {
                // Guardar nueva contraseña
                $userEntity = $this->XservUsuarios->get($user->id);
                $userEntity->password = $hasher->hash($data['new_password']);

                if ($this->XservUsuarios->save($userEntity)) {
                    $this->Flash->success('Contraseña actualizada con éxito.');
                    return $this->redirect(['action' => 'profile']);
                } else {
                    $this->Flash->error('No se pudo actualizar la contraseña, intente de nuevo.');
                }
            }
        }

        $this->set(compact('user'));
    }

}

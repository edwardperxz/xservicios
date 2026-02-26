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
            $this->Flash->success('Inicio de sesión exitoso', [
                'params' => ['i18n' => 'success.login'],
            ]);
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Usuario o contraseña incorrectos', [
                'params' => ['i18n' => 'errors.invalidCredentials'],
            ]);
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

        // Si es una petición AJAX, devolver JSON
        if ($this->request->is('json') || $this->request->getHeader('X-Requested-With') === 'XMLHttpRequest') {
            $this->response = $this->response->withType('application/json');
            return $this->response->withStringBody(json_encode([
                'success' => true,
                'message' => 'Sesión cerrada correctamente',
            ]));
        }

        return $this->redirect(['action' => 'login']);
    }


    public function profile()
    {
        $this->Authorization->skipAuthorization();

        $userIdentity = $this->Authentication->getIdentity();
        if (!$userIdentity) {
            $this->Flash->error('Debe iniciar sesión para ver el perfil', [
                'params' => ['i18n' => 'errors.mustLoginProfile'],
            ]);
            return $this->redirect(['action' => 'login']);
        }

        // Solo redirigir si es chofer
        if ($userIdentity->rol === 'chofer') {
            $chofer = $this->XservUsuarios->XservChoferes
                ->find()
                ->where(['usuario_id' => $userIdentity->id])
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

        // Para admin u operador, mostrar interfaz completa del perfil
        $usuario = $this->XservUsuarios->get($userIdentity->id);
        $this->set(compact('usuario'));
        $this->viewBuilder()->disableAutoLayout();
        $this->render('/Profile/index');
    }

    public function me(): ?Response
    {
        $this->Authorization->skipAuthorization();

        // Verificar si es una petición AJAX
        $isAjax = $this->request->is('json') || 
                  $this->request->getHeader('X-Requested-With') === 'XMLHttpRequest' ||
                  ($this->request->hasHeader('X-Requested-With') && 
                   $this->request->getHeaderLine('X-Requested-With') === 'XMLHttpRequest');

        $user = $this->Authentication->getIdentity();
        if (!$user) {
            if ($isAjax) {
                $this->response = $this->response->withType('application/json')->withStatus(401);
                return $this->response->withStringBody(json_encode([
                    'success' => false,
                    'message' => 'No autenticado',
                ]));
            }

            return $this->redirect(['action' => 'login']);
        }

        if ($isAjax) {
            $this->response = $this->response->withType('application/json');
            return $this->response->withStringBody(json_encode([
                'success' => true,
                'user' => [
                    'id' => $user->id ?? null,
                    'username' => $user->username ?? null,
                    'correo' => $user->correo ?? null,
                    'rol' => $user->rol ?? null,
                ],
            ]));
        }

        return $this->redirect(['action' => 'profile']);
    }



    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        
        // Obtener usuario autenticado
        $user = $this->Authentication->getIdentity();
        $isAdmin = $user && $user->rol === 'admin';
        
        // Configurar layout para admin
        if ($isAdmin) {
            $this->viewBuilder()->setLayout('admin');
        }

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

        $this->set(compact('xservUsuarios', 'filters', 'user'));
        
        // Renderizar vista específica para admin
        if ($isAdmin) {
            $this->render('admin_index');
        }
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
        
        // Usar layout admin para usuarios con rol admin
        $authUser = $this->Authentication->getIdentity();
        if ($authUser && $authUser->rol === 'admin') {
            $this->viewBuilder()->setLayout('admin');
        }
        
        $xservUsuario = $this->XservUsuarios->get($id, contain: []);
        $this->set(compact('xservUsuario', 'authUser'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();
        
        // Verificar si el usuario autenticado es admin
        $authUser = $this->Authentication->getIdentity();
        $isAdmin = $authUser && $authUser->rol === 'admin';
        
        if ($isAdmin) {
            $this->viewBuilder()->setLayout('admin');
        }
        
        $xservUsuario = $this->XservUsuarios->newEmptyEntity();
        
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            // Si es admin, puede asignar cualquier rol, sino forzamos cliente
            if (!$isAdmin) {
                $data['rol'] = 'cliente';
                $data['estado'] = 'activo';
            }
            
            $xservUsuario = $this->XservUsuarios->patchEntity($xservUsuario, $data);

            if ($this->XservUsuarios->save($xservUsuario)) {
                if ($isAdmin) {
                    $this->Flash->success(__('El usuario ha sido creado exitosamente.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->success(__('Cuenta creada con éxito. Ya puedes iniciar sesión.'));
                    return $this->redirect(['action' => 'login']);
                }
            }
            $this->Flash->error(__('No se pudo crear el usuario. Por favor, intente de nuevo.'));
        }
        
        $this->set(compact('xservUsuario', 'authUser', 'isAdmin'));
        
        if ($isAdmin) {
            $this->render('admin_form');
        }
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
        
        // Usar layout admin para usuarios con rol admin
        $authUser = $this->Authentication->getIdentity();
        $isAdmin = $authUser && $authUser->rol === 'admin';
        
        if ($isAdmin) {
            $this->viewBuilder()->setLayout('admin');
        }
        
        $xservUsuario = $this->XservUsuarios->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            
            // No permitir cambio de contraseña vacía
            if (empty($data['password'])) {
                unset($data['password']);
            }
            
            $xservUsuario = $this->XservUsuarios->patchEntity($xservUsuario, $data);
            if ($this->XservUsuarios->save($xservUsuario)) {
                $this->Flash->success(__('El usuario ha sido actualizado.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El usuario no pudo ser actualizado. Por favor, intente de nuevo.'));
        }
        $this->set(compact('xservUsuario', 'authUser', 'isAdmin'));
        
        if ($isAdmin) {
            $this->render('admin_form');
        }
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
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'delete']);
        
        // Obtener el usuario autenticado
        $authUser = $this->Authentication->getIdentity();
        
        // Verificar que el usuario no intente eliminarse a sí mismo
        if ($authUser && $authUser->id == $id) {
            $this->Flash->error(__('No puedes eliminarte a ti mismo.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $xservUsuario = $this->XservUsuarios->get($id);
        if ($this->XservUsuarios->delete($xservUsuario)) {
            $this->Flash->success(__('El usuario ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El usuario no pudo ser eliminado. Por favor, intente de nuevo.'));
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

            // Validar que las contraseñas coincidan
            if (isset($data['password_confirm']) && $data['password'] !== $data['password_confirm']) {
                $this->Flash->error('Las contraseñas no coinciden', [
                    'params' => ['i18n' => 'errors.passwordMismatch'],
                ]);
                $this->set(compact('xservUsuario'));
                return null;
            }

            // Remover el campo de confirmación antes de guardar
            unset($data['password_confirm']);

            // valores por defecto obligatorios
            $data['rol'] = 'operador';
            $data['estado'] = 'activo';

            $xservUsuario = $this->XservUsuarios->newEntity($data);

            if ($this->XservUsuarios->save($xservUsuario)) {
                $this->Flash->success('Cuenta creada correctamente', [
                    'params' => ['i18n' => 'success.register'],
                ]);

                return $this->redirect(['action' => 'login']);
            }

            // Mostrar errores de validación específicos
            $errors = $xservUsuario->getErrors();
            if (!empty($errors)) {
                if (isset($errors['password'])) {
                    foreach ($errors['password'] as $rule => $error) {
                        if ($rule === 'minLength') {
                            $this->Flash->error('La contraseña debe tener al menos 8 caracteres', [
                                'params' => ['i18n' => 'errors.passwordMinLength'],
                            ]);
                        } elseif ($rule === 'strongPassword') {
                            $this->Flash->error('La contraseña debe contener al menos una mayúscula y un número', [
                                'params' => ['i18n' => 'errors.passwordRequirements'],
                            ]);
                        } else {
                            $this->Flash->error($error, [
                                'params' => ['i18n' => 'errors.passwordInvalid'],
                            ]);
                        }
                    }
                }
                if (isset($errors['username'])) {
                    foreach ($errors['username'] as $rule => $error) {
                        if ($rule === 'unique') {
                            $this->Flash->error('El nombre de usuario ya está en uso', [
                                'params' => ['i18n' => 'errors.usernameTaken'],
                            ]);
                        } else {
                            $this->Flash->error($error, [
                                'params' => ['i18n' => 'errors.usernameInvalid'],
                            ]);
                        }
                    }
                }
                if (isset($errors['correo'])) {
                    foreach ($errors['correo'] as $rule => $error) {
                        if ($rule === 'email') {
                            $this->Flash->error('Debe ingresar un correo electrónico válido', [
                                'params' => ['i18n' => 'errors.emailInvalid'],
                            ]);
                        } elseif ($rule === 'unique') {
                            $this->Flash->error('Este correo electrónico ya está registrado', [
                                'params' => ['i18n' => 'errors.emailTaken'],
                            ]);
                        } elseif ($rule === 'notEmptyString' || $rule === '_empty') {
                            $this->Flash->error('El correo electrónico es requerido', [
                                'params' => ['i18n' => 'errors.emailRequired'],
                            ]);
                        } else {
                            $this->Flash->error($error, [
                                'params' => ['i18n' => 'errors.emailInvalid'],
                            ]);
                        }
                    }
                }
            } else {
                $this->Flash->error('No se pudo crear la cuenta', [
                    'params' => ['i18n' => 'errors.registerFailed'],
                ]);
            }
        }

        $this->set(compact('xservUsuario'));

        return null;
    }

    public function changePassword()
    {
        $this->Authorization->skipAuthorization(); // temporal si no quieres autorización complicada

        $user = $this->Authentication->getIdentity();
        if (!$user) {
            $this->Flash->error('Debe iniciar sesión para cambiar la contraseña.', [
                'params' => ['i18n' => 'errors.mustLoginChangePassword'],
            ]);
            return $this->redirect(['action' => 'login']);
        }

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();

            $hasher = new \Authentication\PasswordHasher\DefaultPasswordHasher();

            // Verificar contraseña actual
            if (!$hasher->check($data['current_password'], $user->password)) {
                $this->Flash->error('La contraseña actual es incorrecta.', [
                    'params' => ['i18n' => 'errors.currentPasswordIncorrect'],
                ]);
            } elseif ($data['new_password'] !== $data['confirm_password']) {
                $this->Flash->error('La nueva contraseña y la confirmación no coinciden.', [
                    'params' => ['i18n' => 'errors.newPasswordMismatch'],
                ]);
            } else {
                // Guardar nueva contraseña
                $userEntity = $this->XservUsuarios->get($user->id);
                $userEntity->password = $hasher->hash($data['new_password']);

                if ($this->XservUsuarios->save($userEntity)) {
                    $this->Flash->success('Contraseña actualizada con éxito.', [
                        'params' => ['i18n' => 'success.passwordUpdated'],
                    ]);
                    return $this->redirect(['action' => 'profile']);
                } else {
                    $this->Flash->error('No se pudo actualizar la contraseña, intente de nuevo.', [
                        'params' => ['i18n' => 'errors.passwordUpdateFailed'],
                    ]);
                }
            }
        }

        $this->set(compact('user'));
    }

}

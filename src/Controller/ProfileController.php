<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;
use Cake\ORM\Locator\LocatorAwareTrait;

class ProfileController extends AppController
{
    use LocatorAwareTrait;

    /**
     * Display user profile page
     */
    public function index()
    {
        // Obtener el usuario autenticado
        $userIdentity = $this->Authentication->getIdentity();
        
        if (!$userIdentity) {
            return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'login']);
        }

        // Obtener la entidad del usuario desde la BD
        $usuariosTable = $this->fetchTable('XservUsuarios');
        $usuario = $usuariosTable->get($userIdentity->get('id'));
        
        if (!$usuario) {
            throw new NotFoundException('Usuario no encontrado');
        }

        // Verificación de autorización
        $this->Authorization->authorize($usuario, 'view');

        // Pasar datos a la vista
        $this->set(compact('usuario'));
        $this->viewBuilder()->disableAutoLayout();
    }

    /**
     * Edit user profile
     */
    public function edit()
    {
        // Obtener el usuario autenticado
        $userIdentity = $this->Authentication->getIdentity();
        
        if (!$userIdentity) {
            return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'login']);
        }

        // Obtener la entidad del usuario desde la BD
        $usuariosTable = $this->fetchTable('XservUsuarios');
        $usuario = $usuariosTable->get($userIdentity->get('id'));
        
        if (!$usuario) {
            throw new NotFoundException('Usuario no encontrado');
        }

        // Verificación de autorización
        $this->Authorization->authorize($usuario, 'edit');

        // Procesar POST
        if ($this->getRequest()->is(['post', 'put'])) {
            $usuario = $usuariosTable->patchEntity($usuario, $this->getRequest()->getData(), [
                'fields' => ['nombre', 'username', 'correo', 'telefono']
            ]);

            // Validar y guardar
            if ($usuariosTable->save($usuario)) {
                $this->Flash->success('Tu perfil ha sido actualizado exitosamente.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('No se pudo guardar los cambios. Por favor intenta nuevamente.');
            }
        }

        // Pasar datos a la vista
        $this->set(compact('usuario'));
        $this->viewBuilder()->disableAutoLayout();
    }
}


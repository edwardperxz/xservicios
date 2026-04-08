<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Utility\DemoData;
use Cake\Event\EventInterface;
use Cake\Http\Exception\NotFoundException;
use Cake\ORM\Locator\LocatorAwareTrait;

class ProfileController extends AppController
{
    use LocatorAwareTrait;

    public function beforeFilter(EventInterface $event): void
    {
        parent::beforeFilter($event);

        if (DemoData::isEnabled()) {
            $this->Authentication->addUnauthenticatedActions(['index', 'edit', 'settings']);
            $this->Authorization->skipAuthorization();
        }
    }

    private function demoUsuario(): \ArrayObject
    {
        return new \ArrayObject([
            'id' => 101,
            'nombre' => 'Demo',
            'username' => 'demo',
            'correo' => 'demo@xservicios.com',
            'telefono' => '+507 6000-0000',
            'estado' => true,
            'rol' => 'cliente',
            'pais' => 'PANAMA',
        ], \ArrayObject::ARRAY_AS_PROPS);
    }

    /**
     * Display user profile page
     */
    public function index()
    {
        if (DemoData::isEnabled()) {
            $usuario = $this->demoUsuario();
            $reservasFinalizadas = [];
            $this->set(compact('usuario', 'reservasFinalizadas'));
            $this->viewBuilder()->disableAutoLayout();
            return;
        }

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

        // Obtener reservas finalizadas si el usuario tiene cliente vinculado
        $reservasFinalizadas = [];
        $clientesTable = $this->fetchTable('XservClientes');
        $cliente = $clientesTable->findByUsuarioId($usuario->id)->first();
        
        if ($cliente) {
            $reservasTable = $this->fetchTable('XservReservas');
            $reservasFinalizadas = $reservasTable->find()
                ->where(['cliente_id' => $cliente->id, 'estado' => 'finalizada'])
                ->contain(['Asignaciones' => ['Chofer'], 'Valoraciones'])
                ->order(['updated_at' => 'DESC'])
                ->toArray();
        }

        // Pasar datos a la vista
        $this->set(compact('usuario', 'reservasFinalizadas'));
        $this->viewBuilder()->disableAutoLayout();
    }

    /**
     * Edit user profile
     */
    public function edit()
    {
        if (DemoData::isEnabled()) {
            $usuario = $this->demoUsuario();
            $chofer = null;

            if ($this->getRequest()->is(['post', 'put'])) {
                $this->Flash->success('Perfil Demo actualizado correctamente.');
                return $this->redirect(['action' => 'index']);
            }

            $this->set(compact('usuario', 'chofer'));
            $this->viewBuilder()->disableAutoLayout();
            return;
        }

        // Obtener el usuario autenticado
        $userIdentity = $this->Authentication->getIdentity();
        
        if (!$userIdentity) {
            return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'login']);
        }

        // Obtener la entidad del usuario desde la BD
        $usuariosTable = $this->fetchTable('XservUsuarios');
        $usuario = $usuariosTable->get($userIdentity->get('id'), [
            'contain' => ['XservChoferes']
        ]);
        
        if (!$usuario) {
            throw new NotFoundException('Usuario no encontrado');
        }

        // Verificación de autorización
        $this->Authorization->authorize($usuario, 'edit');

        // Obtener perfil de chofer si aplica
        $chofer = null;
        if ($usuario->rol === 'chofer' && !empty($usuario->xserv_chofere)) {
            $chofer = $usuario->xserv_chofere;
        }

        // Procesar POST
        if ($this->getRequest()->is(['post', 'put'])) {
            // Debug: Log de datos recibidos
            \Cake\Log\Log::debug('POST recibido en profile/edit');
            \Cake\Log\Log::debug('Rol usuario: ' . $usuario->rol);
            \Cake\Log\Log::debug('Tiene chofer: ' . ($chofer ? 'Sí' : 'No'));
            
            // Debug: Ver todos los datos POST
            $allData = $this->getRequest()->getData();
            \Cake\Log\Log::debug('Claves de POST: ' . implode(', ', array_keys($allData)));
            \Cake\Log\Log::debug('Content-Type: ' . $this->getRequest()->getHeaderLine('Content-Type'));
            
            // Debug: Ver FILES
            $files = $this->getRequest()->getUploadedFiles();
            \Cake\Log\Log::debug('Archivos en $_FILES: ' . implode(', ', array_keys($files)));
            if (!empty($files)) {
                foreach ($files as $key => $file) {
                    \Cake\Log\Log::debug("  $key: " . (is_object($file) ? get_class($file) : gettype($file)));
                }
            }
            
            $usuario = $usuariosTable->patchEntity($usuario, $this->getRequest()->getData(), [
                'fields' => ['nombre', 'username', 'correo', 'telefono']
            ]);

            // Manejar foto del chofer si es rol chofer (IGUAL AL ADMIN)
            if ($usuario->rol === 'chofer' && $chofer) {
                $choferesTable = $this->fetchTable('XservChoferes');
                $choferEntity = $choferesTable->get($chofer->id);
                $data = $this->getRequest()->getData();
                
                // Manejar carga de archivo (IDÉNTICO AL ADMIN)
                if (!empty($data['foto']) && $data['foto']->getSize() > 0) {
                    $uploadDir = WWW_ROOT . 'img' . DS . 'choferes' . DS;
                    
                    // Crear directorio si no existe
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    
                    // Eliminar foto anterior si existe
                    if (!empty($choferEntity->foto_url)) {
                        $oldPath = WWW_ROOT . ltrim($choferEntity->foto_url, '/');
                        if (is_file($oldPath)) {
                            unlink($oldPath);
                        }
                    }
                    
                    $file = $data['foto'];
                    $filename = time() . '_' . $file->getClientFilename();
                    $filepath = $uploadDir . $filename;
                    
                    // Mover archivo cargado
                    try {
                        $file->moveTo($filepath);
                        $data['foto_url'] = '/img/choferes/' . $filename;
                    } catch (\Exception $e) {
                        $this->Flash->error('Error al subir la imagen.');
                        return;
                    }
                }
                
                // Eliminar la clave 'foto' si existe (no es parte del modelo)
                unset($data['foto']);
                
                // Actualizar los datos del usuario con los datos modificados
                $usuario = $usuariosTable->patchEntity($usuario, $data, [
                    'fields' => ['nombre', 'username', 'correo', 'telefono']
                ]);
                
                // Guardar usuario
                if ($usuariosTable->save($usuario)) {
                    // Ahora actualizar el chofer con foto_url
                    if (isset($data['foto_url'])) {
                        $choferEntity = $choferesTable->patchEntity($choferEntity, ['foto_url' => $data['foto_url']]);
                        $choferesTable->save($choferEntity);
                        $this->Flash->success('Foto actualizada exitosamente.');
                    } else {
                        $this->Flash->success('Tu perfil ha sido actualizado exitosamente.');
                    }
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error('No se pudo guardar los cambios. Por favor intenta nuevamente.');
                }
            }

            // Validar y guardar usuario
            if ($usuariosTable->save($usuario)) {
                $this->Flash->success('Tu perfil ha sido actualizado exitosamente.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('No se pudo guardar los cambios. Por favor intenta nuevamente.');
            }
        }

        // Pasar datos a la vista
        $this->set(compact('usuario', 'chofer'));
        $this->viewBuilder()->disableAutoLayout();
    }

    /**
     * Configuración de preferencias para choferes
     */
    public function settings()
    {
        if (DemoData::isEnabled()) {
            $usuario = $this->demoUsuario();

            if ($this->getRequest()->is(['post', 'put'])) {
                $this->Flash->success('Preferencias Demo guardadas correctamente.');
                return $this->redirect(['action' => 'settings']);
            }

            $this->set(compact('usuario'));
            $this->viewBuilder()->disableAutoLayout();
            return;
        }

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

        // Procesar POST (actualizar preferencias)
        if ($this->getRequest()->is(['post', 'put'])) {
            $data = $this->getRequest()->getData();
            
            // Campos que se pueden actualizar
            $allowedFields = [
                'notificaciones_activadas',
                'recibir_ofertas',
                'compartir_ubicacion',
                'modo_disponible'
            ];
            
            $usuario = $usuariosTable->patchEntity($usuario, $data, [
                'fields' => $allowedFields
            ]);

            if ($usuariosTable->save($usuario)) {
                $this->Flash->success('Tus preferencias han sido guardadas exitosamente.');
                return $this->redirect(['action' => 'settings']);
            } else {
                $this->Flash->error('No se pudo guardar los cambios. Por favor intenta nuevamente.');
            }
        }

        // Pasar datos a la vista
        $this->set(compact('usuario'));
        $this->viewBuilder()->disableAutoLayout();
    }

    /**
     * Guardar valoración de una reserva
     */
    public function saveValoracion()
    {
        // Solo POST
        $this->request->allowMethod(['post']);

        // Obtener usuario autenticado
        $userIdentity = $this->Authentication->getIdentity();
        if (!$userIdentity) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'No autenticado']));
        }

        // Obtener datos JSON
        $data = json_decode($this->request->getBody(), true);
        
        if (!$data || !isset($data['reserva_id'])) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Datos inválidos']));
        }

        // Validar que el usuario sea propietario de la reserva
        $reservasTable = $this->fetchTable('XservReservas');
        $reserva = $reservasTable->get($data['reserva_id']);
        
        // Obtener cliente vinculado al usuario
        $clientesTable = $this->fetchTable('XservClientes');
        $cliente = $clientesTable->findByUsuarioId($userIdentity->get('id'))->first();
        
        if (!$cliente || $reserva->cliente_id != $cliente->id) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'No autorizado']));
        }

        // Crear o actualizar valoración
        $valoracionesTable = $this->fetchTable('XservValoraciones');
        $valoracion = $valoracionesTable->findByReservaId($data['reserva_id'])->first();
        
        if (!$valoracion) {
            $valoracion = $valoracionesTable->newEmptyEntity();
        }

        // Preparar datos
        $datosValoracion = [
            'reserva_id' => $data['reserva_id'],
            'puntuacion_limpieza' => $data['puntuacion_limpieza'] ?? null,
            'puntuacion_puntualidad' => $data['puntuacion_puntualidad'] ?? null,
            'calificacion' => $data['calificacion'] ?? null,
            'comentarios' => $data['comentarios'] ?? null,
            'mostrar_en_web' => true,
            'estado_moderacion' => 'pendiente'
        ];

        // Parchear y guardar
        $valoracion = $valoracionesTable->patchEntity($valoracion, $datosValoracion);
        
        if ($valoracionesTable->save($valoracion)) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'message' => 'Valoración guardada exitosamente',
                    'data' => $valoracion
                ]));
        } else {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => 'Error al guardar la valoración',
                    'errors' => $valoracion->getErrors()
                ]));
        }
    }
}


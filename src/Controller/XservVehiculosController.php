<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * XservVehiculos Controller
 *
 * @property \App\Model\Table\XservVehiculosTable $XservVehiculos
 */
class XservVehiculosController extends AppController
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
        $this->Authorization->skipAuthorization();
        
        $user = $this->Authentication->getIdentity();
        $isAdmin = $user && $user->rol === 'admin';
        
        $query = $this->XservVehiculos->find();
        
        $filters = $this->request->getQuery();
        
        if (!empty($filters['tipo'])) {
            $query->where(['tipo' => $filters['tipo']]);
        }
        
        if (!empty($filters['estado_operativo'])) {
            $query->where(['estado_operativo' => $filters['estado_operativo']]);
        }
        
        if (!empty($filters['placa'])) {
            $query->where(['OR' => [
                'placa LIKE' => '%' . $filters['placa'] . '%',
                'nombre_unidad LIKE' => '%' . $filters['placa'] . '%'
            ]]);
        }
        
        $xservVehiculos = $this->paginate($query);
        
        $this->set(compact('xservVehiculos', 'filters'));
        
        if ($isAdmin) {
            $this->render('admin_index');
        }
    }

    public function vehicles()
    {
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('vehicles');

        $vehiculos = $this->paginate(
            $this->XservVehiculos->find()->order(['anio' => 'DESC'])
        );

        $this->set(compact('vehiculos'));
    }

    /**
     * Admin index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function adminIndex()
    {
        $this->Authorization->skipAuthorization();

        $user = $this->Authentication->getIdentity();
        if (!$user || $user->rol !== 'admin') {
            return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'profile']);
        }

        $this->viewBuilder()->setLayout('admin');

        $query = $this->XservVehiculos->find();

        $filters = $this->request->getQuery();

        if (!empty($filters['tipo'])) {
            $query->where(['tipo' => $filters['tipo']]);
        }

        if (!empty($filters['estado_operativo'])) {
            $query->where(['estado_operativo' => $filters['estado_operativo']]);
        }

        if (!empty($filters['placa'])) {
            $query->where(['OR' => [
                'placa LIKE' => '%' . $filters['placa'] . '%',
                'nombre_unidad LIKE' => '%' . $filters['placa'] . '%'
            ]]);
        }

        $xservVehiculos = $this->paginate($query);

        $this->set(compact('xservVehiculos', 'filters'));
        $this->render('admin_index');
    }

    /**
     * View method
     *
     * @param string|null $id Xserv Vehiculo id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $this->Authorization->skipAuthorization();
        $xservVehiculo = $this->XservVehiculos->get($id, contain: []);
        $this->set(compact('xservVehiculo'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();
        $xservVehiculo = $this->XservVehiculos->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            // Manejar carga de archivo
            if (!empty($data['foto']) && $data['foto']->getSize() > 0) {
                $uploadDir = WWW_ROOT . 'img' . DS . 'vehiculos' . DS;
                
                // Crear directorio si no existe
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                $file = $data['foto'];
                $filename = time() . '_' . $file->getClientFilename();
                $filepath = $uploadDir . $filename;
                
                // Mover archivo cargado
                try {
                    $file->moveTo($filepath);
                    $data['foto_url'] = '/img/vehiculos/' . $filename;
                } catch (\Exception $e) {
                    $this->Flash->error(__('Error al subir la imagen.'));
                    $this->set(compact('xservVehiculo'));
                    return;
                }
            }
            
            // Eliminar la clave 'foto' si existe (no es parte del modelo)
            unset($data['foto']);
            
            $xservVehiculo = $this->XservVehiculos->patchEntity($xservVehiculo, $data);
            if ($this->XservVehiculos->save($xservVehiculo)) {
                $this->Flash->success(__('The xserv vehiculo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv vehiculo could not be saved. Please, try again.'));
        }
        $this->set(compact('xservVehiculo'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xserv Vehiculo id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $this->Authorization->skipAuthorization();
        $xservVehiculo = $this->XservVehiculos->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            
            // Manejar carga de archivo
            if (!empty($data['foto']) && $data['foto']->getSize() > 0) {
                $uploadDir = WWW_ROOT . 'img' . DS . 'vehiculos' . DS;
                
                // Crear directorio si no existe
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                // Eliminar foto anterior si existe
                if (!empty($xservVehiculo->foto_url)) {
                    $oldPath = WWW_ROOT . ltrim($xservVehiculo->foto_url, '/');
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
                    $data['foto_url'] = '/img/vehiculos/' . $filename;
                } catch (\Exception $e) {
                    $this->Flash->error(__('Error al subir la imagen.'));
                    $this->set(compact('xservVehiculo'));
                    return;
                }
            }
            
            // Eliminar la clave 'foto' si existe (no es parte del modelo)
            unset($data['foto']);
            
            $xservVehiculo = $this->XservVehiculos->patchEntity($xservVehiculo, $data);
            if ($this->XservVehiculos->save($xservVehiculo)) {
                $this->Flash->success(__('The xserv vehiculo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xserv vehiculo could not be saved. Please, try again.'));
        }
        $this->set(compact('xservVehiculo'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xserv Vehiculo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'delete']);
        $xservVehiculo = $this->XservVehiculos->get($id);
        if ($this->XservVehiculos->delete($xservVehiculo)) {
            $this->Flash->success(__('The xserv vehiculo has been deleted.'));
        } else {
            $this->Flash->error(__('The xserv vehiculo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

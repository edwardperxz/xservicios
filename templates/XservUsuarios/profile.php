<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservUsuario $xservUsuario
 */
// src/Controller/DashboardController.php
namespace App\Controller;

class DashboardController extends AppController
{
    public function index()
    {
        $user = $this->request->getAttribute('identity');
        if (!$user) return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'login']);

        $rol = $user->rol;
        $this->set(compact('rol', 'user'));

        // Puedes redirigir directamente a sub-panel
        switch ($rol) {
            case 'admin':
                return $this->redirect(['action' => 'adminPanel']);
            case 'operador':
                return $this->redirect(['action' => 'operadorPanel']);
            case 'chofer':
                return $this->redirect(['action' => 'choferPanel']);
        }
    }

    public function adminPanel()
    {
        $this->Authorization->skipAuthorization();
        // Ejemplo: contar reservas y usuarios
        $this->loadModel('XservUsuarios');
        $this->loadModel('XservReservas');

        $totalUsuarios = $this->XservUsuarios->find()->count();
        $totalReservas = $this->XservReservas->find()->count();

        $this->set(compact('totalUsuarios', 'totalReservas'));
    }

    public function operadorPanel()
    {
        $this->Authorization->skipAuthorization();
        $this->loadModel('XservReservas');
        $reservasPendientes = $this->XservReservas->find()
            ->where(['estado' => 'pendiente'])
            ->count();
        $this->set(compact('reservasPendientes'));
    }

    public function choferPanel()
    {
        $this->Authorization->skipAuthorization();
        $this->loadModel('XservAsignaciones');
        $user = $this->request->getAttribute('identity');

        $misAsignaciones = $this->XservAsignaciones->find()
            ->where(['chofer_id' => $user->id, 'estado_asignacion !=' => 'finalizada'])
            ->all();

        $this->set(compact('misAsignaciones'));
    }
}

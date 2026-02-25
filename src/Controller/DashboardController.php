<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\I18n\FrozenDate;

class DashboardController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');
        $this->loadComponent('Authorization.Authorization');
    }

    public function beforeFilter(EventInterface $event): void
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions([]);
    }

    public function adminPanel()
    {
        $user = $this->request->getAttribute('identity');
        $this->Authorization->skipAuthorization();

        if (!$user || $user->rol !== 'admin') {
            return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'profile']);
        }

        $this->viewBuilder()->setLayout('admin');

        // Cargar tablas necesarias
        $reservasTable = $this->fetchTable('XservReservas');
        $vehiculosTable = $this->fetchTable('XservVehiculos');
        $choferesTable = $this->fetchTable('XservChoferes');
        $valoracionesTable = $this->fetchTable('XservValoraciones');
        $ejecucionViajesTable = $this->fetchTable('XservEjecucionViajes');
        $incidenciasTable = $this->fetchTable('XservIncidenciasViaje');

        // KPIs de Reservas
        $hoy = FrozenDate::now();
        $inicioSemana = $hoy->startOfWeek();
        $inicioMes = $hoy->startOfMonth();

        $reservasHoy = $reservasTable->find()
            ->where(['DATE(fecha)' => $hoy->format('Y-m-d')])
            ->count();

        $reservasSemana = $reservasTable->find()
            ->where(['fecha >=' => $inicioSemana])
            ->count();

        $reservasMes = $reservasTable->find()
            ->where(['fecha >=' => $inicioMes])
            ->count();

        // Reservas por estado
        $reservasPorEstado = $reservasTable->find()
            ->select([
                'estado',
                'total' => $reservasTable->find()->func()->count('*')
            ])
            ->group('estado')
            ->toArray();

        // Tasa de ocupación de flota
        $totalVehiculos = $vehiculosTable->find()
            ->where(['estado_operativo' => 'disponible'])
            ->count();

        $vehiculosAsignados = $vehiculosTable->find()
            ->where(['estado_operativo' => 'asignado'])
            ->count();

        $tasaOcupacion = $totalVehiculos > 0 
            ? round(($vehiculosAsignados / $totalVehiculos) * 100, 2) 
            : 0;

        // Calificación promedio
        $calificacionPromedio = $valoracionesTable->find()
            ->select(['promedio' => $valoracionesTable->find()->func()->avg('calificacion')])
            ->first();

        $calificacionPromedio = ($calificacionPromedio && $calificacionPromedio->promedio !== null)
            ? round((float)$calificacionPromedio->promedio, 2) 
            : 0;

        // Próximas reservas (las 10 más cercanas)
        $proximasReservas = $reservasTable->find()
            ->contain(['Clientes', 'Servicios'])
            ->where([
                'XservReservas.fecha >=' => $hoy,
                'XservReservas.estado IN' => ['pendiente', 'confirmada', 'asignada']
            ])
            ->order(['XservReservas.fecha' => 'ASC', 'XservReservas.hora' => 'ASC'])
            ->limit(10)
            ->toArray();

        // Alertas
        $incidenciasAbiertas = $incidenciasTable->find()
            ->where(['resuelto' => false])
            ->count();

        $vehiculosMantenimiento = $vehiculosTable->find()
            ->where(['estado_operativo' => 'mantenimiento'])
            ->count();

        $choferesDisponibles = $choferesTable->find()
            ->where(['disponibilidad' => 'disponible'])
            ->count();

        // Estadísticas de servicios completados (últimos 30 días)
        $hace30Dias = $hoy->subDays(30);
        $serviciosCompletados = $ejecucionViajesTable->find()
            ->where([
                'estado_ejecucion' => 'completado',
                'hora_fin_real >=' => $hace30Dias
            ])
            ->count();

        $this->set(compact(
            'user',
            'reservasHoy',
            'reservasSemana',
            'reservasMes',
            'reservasPorEstado',
            'tasaOcupacion',
            'calificacionPromedio',
            'proximasReservas',
            'incidenciasAbiertas',
            'vehiculosMantenimiento',
            'choferesDisponibles',
            'serviciosCompletados',
            'totalVehiculos',
            'vehiculosAsignados'
        ));
    }


    public function operadorPanel()
    {
        $user = $this->request->getAttribute('identity');
        $this->Authorization->skipAuthorization();

        if (!$user || $user->rol !== 'operador') {
            return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'profile']);
        }

        $this->set(compact('user'));

        $this->render('/XservUsuarios/profile');
    }


    public function choferPanel()
    {
        $user = $this->request->getAttribute('identity');
        $this->Authorization->skipAuthorization();

        if (!$user || $user->rol !== 'chofer') {
            return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'profile']);
        }

        $choferesTable = $this->fetchTable('XservChoferes');

        $chofer = $choferesTable
            ->find()
            ->where(['usuario_id' => $user->id])
            ->first();

        $this->set(compact('user', 'chofer'));

        $this->render('/XservUsuarios/profile');
    }

        public function reportes()
        {
            $user = $this->request->getAttribute('identity');
            $this->Authorization->skipAuthorization();

            if (!$user || $user->rol !== 'admin') {
                return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'profile']);
            }

            $this->viewBuilder()->setLayout('admin');

            $summary = $this->getReportesSummary();
            $this->set(array_merge(['user' => $user], $summary));
        }

        public function exportPdf()
        {
            $user = $this->request->getAttribute('identity');
            $this->Authorization->skipAuthorization();

            if (!$user || $user->rol !== 'admin') {
                return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'profile']);
            }

            $this->viewBuilder()->setLayout('admin');
            $summary = $this->getReportesSummary();
            $this->set(array_merge(['user' => $user], $summary));
        }

        public function exportExcel()
        {
            $user = $this->request->getAttribute('identity');
            $this->Authorization->skipAuthorization();

            if (!$user || $user->rol !== 'admin') {
                return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'profile']);
            }

            $summary = $this->getReportesSummary();
            $rows = [
                ['Reporte', 'Total'],
                ['Reservas', $summary['totalReservas']],
                ['Choferes', $summary['totalChoferes']],
                ['Vehiculos', $summary['totalVehiculos']],
                ['Evaluaciones', $summary['totalEvaluaciones']],
                ['Incidencias', $summary['totalIncidencias']],
            ];

            $handle = fopen('php://temp', 'r+');
            foreach ($rows as $row) {
                fputcsv($handle, $row);
            }
            rewind($handle);
            $csv = stream_get_contents($handle);
            fclose($handle);

            $filename = 'reportes_' . date('Ymd_His') . '.csv';

            return $this->response
                ->withType('csv')
                ->withHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
                ->withStringBody($csv);
        }

        public function programarEnvio()
        {
            $user = $this->request->getAttribute('identity');
            $this->Authorization->skipAuthorization();

            if (!$user || $user->rol !== 'admin') {
                return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'profile']);
            }

            $this->viewBuilder()->setLayout('admin');

            if ($this->request->is('post')) {
                $this->Flash->success('Programacion registrada. Se enviara el reporte segun la configuracion.');
                return $this->redirect(['action' => 'reportes']);
            }

            $this->set(compact('user'));
        }

        private function getReportesSummary(): array
        {
            $reservasTable = $this->fetchTable('XservReservas');
            $choferesTable = $this->fetchTable('XservChoferes');
            $vehiculosTable = $this->fetchTable('XservVehiculos');
            $evaluacionesTable = $this->fetchTable('XservValoraciones');
            $incidenciasTable = $this->fetchTable('XservIncidenciasViaje');

            return [
                'totalReservas' => $reservasTable->find()->count(),
                'totalChoferes' => $choferesTable->find()->count(),
                'totalVehiculos' => $vehiculosTable->find()->count(),
                'totalEvaluaciones' => $evaluacionesTable->find()->count(),
                'totalIncidencias' => $incidenciasTable->find()->count(),
            ];
        }

}

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
        // Permitir métodos de API sin validación adicional
        $this->Authentication->addUnauthenticatedActions([]);
        $this->Authorization->skipAuthorization();
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
                'estado' => 'XservReservas.estado',
                'total' => $reservasTable->find()->func()->count('*')
            ])
            ->group('XservReservas.estado')
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

        // Usar layout admin para sidebar y header correctos
        $this->viewBuilder()->setLayout('admin');

        // Cargar tablas necesarias para operador
        $reservasTable = $this->fetchTable('XservReservas');
        $asignacionesTable = $this->fetchTable('XservAsignaciones');
        $choferesTable = $this->fetchTable('XservChoferes');
        $vehiculosTable = $this->fetchTable('XservVehiculos');

        // Estadísticas relevantes para operador
        $hoy = FrozenDate::now();
        
        // Reservas pendientes de asignación
        $reservasPendientes = $reservasTable->find()
            ->where(['XservReservas.estado' => 'pendiente'])
            ->count();
        
        // Asignaciones activas
        $asignacionesActivas = $asignacionesTable->find()
            ->where(['estado_asignacion IN' => ['programada', 'en_curso']])
            ->count();
        
        // Choferes disponibles
        $choferesDisponibles = $choferesTable->find()
            ->where(['disponibilidad' => 'disponible', 'estado' => 'activo'])
            ->count();
        
        // Vehículos disponibles
        $vehiculosDisponibles = $vehiculosTable->find()
            ->where(['estado_operativo' => 'disponible'])
            ->count();

        // Reservas de hoy
        $reservasHoy = $reservasTable->find()
            ->contain(['Clientes', 'Servicios'])
            ->where([
                'DATE(fecha)' => $hoy->format('Y-m-d'),
                'XservReservas.estado IN' => ['pendiente', 'confirmada', 'asignada']
            ])
            ->order(['hora' => 'ASC'])
            ->limit(10)
            ->toArray();

        $this->set(compact(
            'user',
            'reservasPendientes',
            'asignacionesActivas',
            'choferesDisponibles',
            'vehiculosDisponibles',
            'reservasHoy'
        ));

        $this->render('operador_panel');
    }


    public function choferPanel()
    {
        $user = $this->request->getAttribute('identity');
        $this->Authorization->skipAuthorization();

        if (!$user || $user->rol !== 'chofer') {
            return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'profile']);
        }

        $this->viewBuilder()->setLayout('frontend');
        $this->set(compact('user'));
        $this->render('chofer_requests');
    }

    public function requests()
    {
        $user = $this->request->getAttribute('identity');
        $this->Authorization->skipAuthorization();

        if (!$user || $user->rol !== 'chofer') {
            return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'profile']);
        }

        // Cargar asignaciones pendientes del chofer
        $asignacionesTable = $this->fetchTable('XservAsignaciones');
        $asignaciones = $asignacionesTable->find()
            ->where(['XservAsignaciones.chofer_id' => $user->id])
            ->contain([
                'Reservas' => ['Clientes', 'XservServicios'],
                'XservVehiculos',
                'XservRutas'
            ])
            ->order(['XservAsignaciones.created_at' => 'DESC'])
            ->all();

        $this->viewBuilder()->setLayout('frontend');
        $this->set(compact('user', 'asignaciones'));
        $this->render('chofer_requests');
    }

    /**
     * Mostrar notificaciones del chofer
     */
    public function choferNotifications()
    {
        $user = $this->request->getAttribute('identity');
        $this->Authorization->skipAuthorization();

        if (!$user || $user->rol !== 'chofer') {
            return $this->redirect(['controller' => 'XservUsuarios', 'action' => 'profile']);
        }

        // Cargar notificaciones del chofer autenticado
        $notificacionesTable = $this->fetchTable('XservNotificaciones');
        $notificaciones = $notificacionesTable->find()
            ->where(['XservNotificaciones.usuario_id' => $user->id])
            ->contain(['Reservas'])
            ->order(['XservNotificaciones.created_at' => 'DESC'])
            ->all();

        $this->viewBuilder()->setLayout('frontend');
        $this->set(compact('user', 'notificaciones'));
        $this->render('chofer_notifications');
    }

    /**
     * API: Obtener asignaciones del chofer logueado
     */
    public function getAsignaciones()
    {
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');

        if (!$user || $user->rol !== 'chofer') {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'No autorizado']))
                ->withStatus(403);
        }

        $choferesTable = $this->fetchTable('XservChoferes');
        $chofer = $choferesTable->find()
            ->where(['usuario_id' => $user->id])
            ->first();

        if (!$chofer) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Chofer no encontrado']))
                ->withStatus(404);
        }

        $asignacionesTable = $this->fetchTable('XservAsignaciones');
        $asignaciones = $asignacionesTable->find()
            ->where(['chofer_id' => $chofer->id])
            ->contain([
                'Reservas.Clientes.XservUsuarios',
                'Reservas.Servicios',
                'Vehiculos'
            ])
            ->order(['XservAsignaciones.fecha_inicio_pactada' => 'ASC'])
            ->all();

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode(['success' => true, 'asignaciones' => $asignaciones]));
    }

    /**
     * API: Obtener estadísticas del chofer
     */
    public function getChoferStats()
    {
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');

        if (!$user || $user->rol !== 'chofer') {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'No autorizado']))
                ->withStatus(403);
        }

        $choferesTable = $this->fetchTable('XservChoferes');
        $chofer = $choferesTable->find()
            ->where(['usuario_id' => $user->id])
            ->first();

        if (!$chofer) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Chofer no encontrado']))
                ->withStatus(404);
        }

        $asignacionesTable = $this->fetchTable('XservAsignaciones');
        $valoracionesTable = $this->fetchTable('XservValoraciones');

        // Viajes completados este mes
        $inicioMes = new \DateTime('first day of this month');
        $viajesEsteMes = $asignacionesTable->find()
            ->where([
                'chofer_id' => $chofer->id,
                'estado_asignacion' => 'finalizada',
                'fecha_fin_pactada >=' => $inicioMes
            ])
            ->count();

        // Solicitudes pendientes
        $solicitudesPendientes = $asignacionesTable->find()
            ->where([
                'chofer_id' => $chofer->id,
                'estado_asignacion' => 'programada'
            ])
            ->count();

        // Rating promedio
        $reservasIds = $asignacionesTable->find()
            ->select(['reserva_id'])
            ->where(['chofer_id' => $chofer->id])
            ->extract('reserva_id')
            ->toArray();

        $ratingPromedio = 0;
        if (!empty($reservasIds)) {
            $rating = $valoracionesTable->find()
                ->select(['promedio' => $valoracionesTable->find()->func()->avg('calificacion')])
                ->where(['reserva_id IN' => $reservasIds])
                ->first();
            
            $ratingPromedio = $rating && $rating->promedio ? round((float)$rating->promedio, 1) : 0;
        }

        // Total de notificaciones no leídas (para el badge del header)
        $notificacionesTable = $this->fetchTable('XservNotificaciones');
        $notificacionesPendientes = $notificacionesTable->find()
            ->where([
                'usuario_id' => $user->id,
                'estado_envio' => 'pendiente'
            ])
            ->count();

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode([
                'success' => true,
                'stats' => [
                    'viajesEsteMes' => $viajesEsteMes,
                    'ratingPromedio' => $ratingPromedio,
                    'solicitudesPendientes' => $solicitudesPendientes,
                    'notificacionesPendientes' => $notificacionesPendientes
                ]
            ]));
    }

    /**
     * API: Aceptar o rechazar asignación
     */
    public function updateAsignacion()
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'put']);
        
        $user = $this->request->getAttribute('identity');
        if (!$user || $user->rol !== 'chofer') {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'No autorizado']))
                ->withStatus(403);
        }

        $data = $this->request->getData();
        $asignacionId = $data['asignacion_id'] ?? null;
        $accion = $data['accion'] ?? null; // 'aceptar' o 'rechazar'

        if (!$asignacionId || !$accion) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Datos incompletos']))
                ->withStatus(400);
        }

        $choferesTable = $this->fetchTable('XservChoferes');
        $chofer = $choferesTable->find()
            ->where(['usuario_id' => $user->id])
            ->first();

        if (!$chofer) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Chofer no encontrado']))
                ->withStatus(404);
        }

        $asignacionesTable = $this->fetchTable('XservAsignaciones');
        $asignacion = $asignacionesTable->get($asignacionId);

        if ($asignacion->chofer_id !== $chofer->id) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Esta asignación no te pertenece']))
                ->withStatus(403);
        }

        if ($accion === 'aceptar') {
            $asignacion->estado_asignacion = 'en_curso';
        } elseif ($accion === 'rechazar') {
            $asignacion->estado_asignacion = 'cancelada';
        } else {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Acción inválida']))
                ->withStatus(400);
        }

        if ($asignacionesTable->save($asignacion)) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => true, 'message' => 'Asignación actualizada']));
        } else {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Error al actualizar']))
                ->withStatus(500);
        }
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
            $handle = fopen('php://temp', 'r+');

            // ENCABEZADO GENERAL
            fputcsv($handle, ['REPORTE COMPLETO DEL SISTEMA XSERVICIOS']);
            fputcsv($handle, ['Generado el ' . date('d/m/Y H:i:s')]);
            fputcsv($handle, []);
            fputcsv($handle, []);

            // SERVICIOS
            if (!empty($summary['servicios'])) {
                fputcsv($handle, ['SERVICIOS']);
                fputcsv($handle, []);
                fputcsv($handle, ['ID', 'Nombre', 'Descripción', 'Precio Base', 'Variantes', 'Estado', 'Creado']);
                foreach ($summary['servicios'] as $s) {
                    fputcsv($handle, [
                        $s->id,
                        $s->nombre,
                        substr($s->descripcion ?? '', 0, 100),
                        $s->precio_base,
                        $s->variantes ?? '',
                        $s->estado,
                        $s->created_at ? $s->created_at->format('d/m/Y') : 'N/A'
                    ]);
                }
                fputcsv($handle, []);
                fputcsv($handle, []);
            }

            // RESERVAS
            if (!empty($summary['reservas'])) {
                fputcsv($handle, ['RESERVAS']);
                fputcsv($handle, []);
                fputcsv($handle, ['ID', 'Código Reserva', 'Cliente', 'Servicio', 'Ruta', 'Fecha', 'Hora', 'Pasajeros', 'Precio', 'ITBMS', 'Punto Recogida', 'Punto Destino', 'Estado', 'Estado Pago', 'Creado']);
                foreach ($summary['reservas'] as $r) {
                    fputcsv($handle, [
                        $r->id,
                        $r->codigo_reserva,
                        $r->cliente?->usuario?->nombre ?? $r->cliente?->identificacion_fiscal ?? 'N/A',
                        $r->servicio?->nombre ?? 'N/A',
                        $r->ruta?->id ?? 'N/A',
                        $r->fecha ? $r->fecha->format('d/m/Y') : 'N/A',
                        $r->hora ? $r->hora->format('H:i') : 'N/A',
                        $r->pasajeros ?? 0,
                        $r->precio_pactado,
                        $r->itbms_pactado,
                        $r->punto_recogida ?? '',
                        $r->punto_destino ?? '',
                        $r->estado,
                        $r->estado_pago,
                        $r->created_at ? $r->created_at->format('d/m/Y') : 'N/A'
                    ]);
                }
                fputcsv($handle, []);
                fputcsv($handle, []);
            }

            // RUTAS
            if (!empty($summary['rutas'])) {
                fputcsv($handle, ['RUTAS']);
                fputcsv($handle, []);
                fputcsv($handle, ['ID', 'Origen', 'Destino', 'Precio Base', 'Tiempo Estimado (min)']);
                foreach ($summary['rutas'] as $r) {
                    fputcsv($handle, [
                        $r->id,
                        $r->origen?->nombre ?? 'N/A',
                        $r->destino?->nombre ?? 'N/A',
                        $r->precio_base,
                        $r->tiempo_estimado_min ?? 'N/A'
                    ]);
                }
                fputcsv($handle, []);
                fputcsv($handle, []);
            }

            // CHOFERES
            if (!empty($summary['choferes'])) {
                fputcsv($handle, ['CHOFERES']);
                fputcsv($handle, []);
                fputcsv($handle, ['ID', 'Nombre', 'Email', 'Tipo Licencia', 'Fecha Ingreso', 'Disponibilidad', 'Estado', 'Creado']);
                foreach ($summary['choferes'] as $c) {
                    fputcsv($handle, [
                        $c->id,
                        $c->usuario?->nombre ?? 'N/A',
                        $c->usuario?->correo ?? 'N/A',
                        $c->tipo_licencia ?? 'N/A',
                        $c->fecha_ingreso ? $c->fecha_ingreso->format('d/m/Y') : 'N/A',
                        $c->disponibilidad ?? 'N/A',
                        $c->estado,
                        $c->created_at ? $c->created_at->format('d/m/Y') : 'N/A'
                    ]);
                }
                fputcsv($handle, []);
                fputcsv($handle, []);
            }

            // VEHÍCULOS
            if (!empty($summary['vehiculos'])) {
                fputcsv($handle, ['VEHÍCULOS']);
                fputcsv($handle, []);
                fputcsv($handle, ['ID', 'Tipo', 'Nombre Unidad', 'Placa', 'Capacidad', 'Color', 'Año', 'KM Actual', 'Estado Operativo', 'Creado']);
                foreach ($summary['vehiculos'] as $v) {
                    fputcsv($handle, [
                        $v->id,
                        $v->tipo,
                        $v->nombre_unidad,
                        $v->placa,
                        $v->capacidad_max,
                        $v->color ?? '',
                        $v->anio ?? 'N/A',
                        $v->kilometraje_actual ?? 0,
                        $v->estado_operativo,
                        $v->created_at ? $v->created_at->format('d/m/Y') : 'N/A'
                    ]);
                }
                fputcsv($handle, []);
                fputcsv($handle, []);
            }

            // CLIENTES
            if (!empty($summary['clientes'])) {
                fputcsv($handle, ['CLIENTES']);
                fputcsv($handle, []);
                fputcsv($handle, ['ID', 'Nombre', 'Email', 'Identificación Fiscal', 'Dirección Facturación', 'Idioma Preferido', 'Creado']);
                foreach ($summary['clientes'] as $c) {
                    fputcsv($handle, [
                        $c->id,
                        $c->usuario?->nombre ?? $c->identificacion_fiscal ?? 'N/A',
                        $c->usuario?->correo ?? 'N/A',
                        $c->identificacion_fiscal ?? 'N/A',
                        $c->direccion_facturacion ?? 'N/A',
                        strtoupper($c->idioma_preferido ?? 'es'),
                        $c->created_at ? $c->created_at->format('d/m/Y') : 'N/A'
                    ]);
                }
                fputcsv($handle, []);
                fputcsv($handle, []);
            }

            // USUARIOS
            if (!empty($summary['usuarios'])) {
                fputcsv($handle, ['USUARIOS']);
                fputcsv($handle, []);
                fputcsv($handle, ['ID', 'Nombre Completo', 'Email', 'Teléfono', 'Identificación', 'Rol', 'Estado', 'Creado']);
                foreach ($summary['usuarios'] as $u) {
                    fputcsv($handle, [
                        $u->id,
                        $u->nombre ?? 'N/A',
                        $u->correo ?? 'N/A',
                        $u->telefono ?? 'N/A',
                        $u->identificacion ?? 'N/A',
                        $u->rol,
                        $u->estado,
                        $u->created_at ? $u->created_at->format('d/m/Y') : 'N/A'
                    ]);
                }
                fputcsv($handle, []);
                fputcsv($handle, []);
            }

            // DESTINOS
            if (!empty($summary['destinos'])) {
                fputcsv($handle, ['DESTINOS']);
                fputcsv($handle, []);
                fputcsv($handle, ['ID', 'Ubicación', 'Descripción ES', 'Descripción EN', 'Popular', 'Creado']);
                foreach ($summary['destinos'] as $d) {
                    fputcsv($handle, [
                        $d->id,
                        $d->ubicacion?->nombre ?? 'N/A',
                        substr($d->descripcion_es ?? '', 0, 80),
                        substr($d->descripcion_en ?? '', 0, 80),
                        $d->es_popular ? 'Sí' : 'No',
                        $d->created_at ? $d->created_at->format('d/m/Y') : 'N/A'
                    ]);
                }
                fputcsv($handle, []);
                fputcsv($handle, []);
            }

            // ASIGNACIONES
            if (!empty($summary['asignaciones'])) {
                fputcsv($handle, ['ASIGNACIONES']);
                fputcsv($handle, []);
                fputcsv($handle, ['ID', 'Chofer', 'Vehículo', 'Reserva', 'Fecha Inicio', 'Fecha Fin', 'Estado', 'Observaciones', 'Creado']);
                foreach ($summary['asignaciones'] as $a) {
                    fputcsv($handle, [
                        $a->id,
                        $a->chofer?->usuario?->nombre ?? 'N/A',
                        $a->vehiculo?->placa ?? 'N/A',
                        $a->reserva?->codigo_reserva ?? $a->reserva_id ?? 'N/A',
                        $a->fecha_inicio_pactada ? $a->fecha_inicio_pactada->format('d/m/Y H:i') : 'N/A',
                        $a->fecha_fin_pactada ? $a->fecha_fin_pactada->format('d/m/Y H:i') : 'N/A',
                        $a->estado_asignacion,
                        substr($a->observaciones_chofer ?? '', 0, 100),
                        $a->created_at ? $a->created_at->format('d/m/Y') : 'N/A'
                    ]);
                }
                fputcsv($handle, []);
                fputcsv($handle, []);
            }

            // VALORACIONES
            if (!empty($summary['valoraciones'])) {
                fputcsv($handle, ['VALORACIONES/EVALUACIONES']);
                fputcsv($handle, []);
                fputcsv($handle, ['ID', 'Reserva', 'Calificación', 'Limpieza', 'Puntualidad', 'Comentarios', 'Mostrar Web', 'Moderación', 'Creado']);
                foreach ($summary['valoraciones'] as $v) {
                    fputcsv($handle, [
                        $v->id,
                        $v->reserva?->codigo_reserva ?? $v->reserva_id ?? 'N/A',
                        $v->calificacion . '/5',
                        $v->puntuacion_limpieza ?? 'N/A',
                        $v->puntuacion_puntualidad ?? 'N/A',
                        substr($v->comentarios ?? '', 0, 100),
                        $v->mostrar_en_web ? 'Sí' : 'No',
                        $v->estado_moderacion ?? 'pendiente',
                        $v->created_at ? $v->created_at->format('d/m/Y') : 'N/A'
                    ]);
                }
                fputcsv($handle, []);
                fputcsv($handle, []);
            }

            // NOTIFICACIONES
            if (!empty($summary['notificaciones'])) {
                fputcsv($handle, ['NOTIFICACIONES']);
                fputcsv($handle, []);
                fputcsv($handle, ['ID', 'Tipo', 'Medio', 'Destinatario', 'Contenido', 'Estado Envío', 'Enviado', 'Creado']);
                foreach ($summary['notificaciones'] as $n) {
                    fputcsv($handle, [
                        $n->id,
                        str_replace('_', ' ', ucfirst($n->tipo_notificacion)),
                        $n->medio ?? 'N/A',
                        $n->destinatario ?? $n->usuario?->correo ?? $n->cliente?->usuario?->correo ?? 'Sistema',
                        substr($n->contenido ?? '', 0, 100),
                        $n->estado_envio ?? 'N/A',
                        $n->enviado_at ? $n->enviado_at->format('d/m/Y H:i') : '—',
                        $n->created_at ? $n->created_at->format('d/m/Y') : 'N/A'
                    ]);
                }
                fputcsv($handle, []);
                fputcsv($handle, []);
            }

            // INCIDENCIAS DE VIAJE
            if (!empty($summary['incidencias'])) {
                fputcsv($handle, ['INCIDENCIAS DE VIAJE']);
                fputcsv($handle, []);
                fputcsv($handle, ['ID', 'Ejecución', 'Tipo', 'Descripción', 'Severidad', 'Resuelto', 'Ubicación GPS', 'Fecha']);
                foreach ($summary['incidencias'] as $i) {
                    fputcsv($handle, [
                        $i->id,
                        $i->ejecucion?->id ?? $i->ejecucion_id ?? 'N/A',
                        $i->tipo_incidencia,
                        substr($i->descripcion ?? '', 0, 100),
                        strtoupper($i->severidad ?? 'media'),
                        $i->resuelto ? 'Sí' : 'No',
                        $i->latitud_incidencia !== null && $i->longitud_incidencia !== null
                            ? round((float)$i->latitud_incidencia, 4) . ',' . round((float)$i->longitud_incidencia, 4)
                            : 'N/A',
                        $i->created_at ? $i->created_at->format('d/m/Y') : 'N/A'
                    ]);
                }
                fputcsv($handle, []);
                fputcsv($handle, []);
            }

            // EJECUCIÓN DE VIAJES
            if (!empty($summary['ejecucionViajes'])) {
                fputcsv($handle, ['EJECUCIÓN DE VIAJES']);
                fputcsv($handle, []);
                fputcsv($handle, ['ID', 'Asignación', 'Chofer', 'Vehículo', 'Inicio Real', 'Fin Real', 'KM Inicio', 'KM Fin', 'Estado', 'Observaciones']);
                foreach ($summary['ejecucionViajes'] as $e) {
                    fputcsv($handle, [
                        $e->id,
                        $e->asignacion_id,
                        $e->asignacion?->chofer?->usuario?->nombre ?? 'N/A',
                        $e->asignacion?->vehiculo?->placa ?? 'N/A',
                        $e->hora_inicio_real ? $e->hora_inicio_real->format('d/m/Y H:i') : 'N/A',
                        $e->hora_fin_real ? $e->hora_fin_real->format('d/m/Y H:i') : 'En progreso',
                        number_format($e->km_inicio ?? 0, 0),
                        number_format($e->km_fin ?? 0, 0),
                        $e->estado_ejecucion ?? 'N/A',
                        substr($e->observaciones_finales ?? '', 0, 100)
                    ]);
                }
                fputcsv($handle, []);
                fputcsv($handle, []);
            }

            // UBICACIONES
            if (!empty($summary['ubicaciones'])) {
                fputcsv($handle, ['UBICACIONES']);
                fputcsv($handle, []);
                fputcsv($handle, ['ID', 'Nombre', 'Provincia', 'Coordenadas GPS', 'Creado']);
                foreach ($summary['ubicaciones'] as $u) {
                    fputcsv($handle, [
                        $u->id,
                        $u->nombre,
                        $u->EN_PROVINCIAS ?? 'N/A',
                        $u->direccion_gps ?? 'N/A',
                        $u->created_at ? $u->created_at->format('d/m/Y') : 'N/A'
                    ]);
                }
                fputcsv($handle, []);
                fputcsv($handle, []);
            }

            // RESUMEN EJECUTIVO
            fputcsv($handle, ['RESUMEN EJECUTIVO']);
            fputcsv($handle, []);
            fputcsv($handle, ['Métrica', 'Cantidad']);
            fputcsv($handle, ['Total Servicios', count($summary['servicios'])]);
            fputcsv($handle, ['Total Reservas', count($summary['reservas'])]);
            fputcsv($handle, ['Total Rutas', count($summary['rutas'])]);
            fputcsv($handle, ['Total Choferes', count($summary['choferes'])]);
            fputcsv($handle, ['Total Vehículos', count($summary['vehiculos'])]);
            fputcsv($handle, ['Total Clientes', count($summary['clientes'])]);
            fputcsv($handle, ['Total Usuarios', count($summary['usuarios'])]);
            fputcsv($handle, ['Total Destinos', count($summary['destinos'])]);
            fputcsv($handle, ['Total Asignaciones', count($summary['asignaciones'])]);
            fputcsv($handle, ['Total Valoraciones', count($summary['valoraciones'])]);
            fputcsv($handle, ['Total Notificaciones', count($summary['notificaciones'])]);
            fputcsv($handle, ['Total Incidencias', count($summary['incidencias'])]);
            fputcsv($handle, ['Total Ejecuciones de Viajes', count($summary['ejecucionViajes'])]);
            fputcsv($handle, ['Total Ubicaciones', count($summary['ubicaciones'])]);

            rewind($handle);
            $csv = stream_get_contents($handle);
            fclose($handle);

            $filename = 'xservicios_reporte_' . date('Ymd_His') . '.csv';

            return $this->response
                ->withType('text/csv; charset=UTF-8')
                ->withHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
                ->withHeader('Content-Encoding', 'UTF-8')
                ->withStringBody("\xEF\xBB\xBF" . $csv);  // BOM para Excel con UTF-8
        }

        private function getReportesSummary(): array
        {
            // Cargar todas las tablas necesarias
            $reservasTable = $this->fetchTable('XservReservas');
            $choferesTable = $this->fetchTable('XservChoferes');
            $vehiculosTable = $this->fetchTable('XservVehiculos');
            $valoracionesTable = $this->fetchTable('XservValoraciones');
            $incidenciasTable = $this->fetchTable('XservIncidenciasViaje');
            $serviciosTable = $this->fetchTable('XservServicios');
            $rutasTable = $this->fetchTable('XservRutas');
            $asignacionesTable = $this->fetchTable('XservAsignaciones');
            $usuariosTable = $this->fetchTable('XservUsuarios');
            $clientesTable = $this->fetchTable('XservClientes');
            $destinosTable = $this->fetchTable('XservDestinos');
            $notificacionesTable = $this->fetchTable('XservNotificaciones');
            $ejecucionViajesTable = $this->fetchTable('XservEjecucionViajes');
            $ubicacionesTable = $this->fetchTable('XservUbicaciones');

            // Obtener datos completos con relaciones
            $reservas = $reservasTable->find()
                ->contain(['Clientes' => ['XservUsuarios'], 'Servicios', 'Rutas' => ['Origens', 'Destinos']])
                ->toArray();

            $servicios = $serviciosTable->find()->toArray();

            $rutas = $rutasTable->find()
                ->contain(['Origens', 'Destinos'])
                ->toArray();

            $asignaciones = $asignacionesTable->find()
                ->contain(['Chofers' => ['Usuarios'], 'Vehiculos', 'Reservas', 'AsignadoPors'])
                ->toArray();

            $choferes = $choferesTable->find()
                ->contain(['Usuarios'])
                ->toArray();

            $vehiculos = $vehiculosTable->find()->toArray();

            $usuarios = $usuariosTable->find()->toArray();

            $clientes = $clientesTable->find()
                ->contain(['XservUsuarios'])
                ->toArray();

            $destinos = $destinosTable->find()
                ->contain(['Ubicacions'])
                ->toArray();

            $valoraciones = $valoracionesTable->find()
                ->contain(['XservReservas'])
                ->toArray();

            $notificaciones = $notificacionesTable->find()
                ->contain(['Usuarios', 'Clientes', 'Reservas'])
                ->toArray();

            $incidencias = $incidenciasTable->find()
                ->contain(['Ejecucions'])
                ->toArray();

            $ejecucionViajes = $ejecucionViajesTable->find()
                ->contain(['Asignacions' => ['Chofers' => ['Usuarios'], 'Vehiculos']])
                ->toArray();

            $ubicaciones = $ubicacionesTable->find()->toArray();

            return [
                // Totales para el resumen de la página de reportes
                'totalReservas' => count($reservas),
                'totalChoferes' => count($choferes),
                'totalVehiculos' => count($vehiculos),
                'totalEvaluaciones' => count($valoraciones),
                'totalIncidencias' => count($incidencias),

                // Datos completos por sección
                'servicios' => $servicios,
                'reservas' => $reservas,
                'rutas' => $rutas,
                'asignaciones' => $asignaciones,
                'choferes' => $choferes,
                'vehiculos' => $vehiculos,
                'usuarios' => $usuarios,
                'clientes' => $clientes,
                'destinos' => $destinos,
                'valoraciones' => $valoraciones,
                'notificaciones' => $notificaciones,
                'incidencias' => $incidencias,
                'ejecucionViajes' => $ejecucionViajes,
                'ubicaciones' => $ubicaciones,
            ];
        }

        /**
         * Acción para mostrar los viajes/asignaciones del chofer autenticado
         */
        public function choferViajes()
        {
            $user = $this->request->getAttribute('identity');
            $this->Authorization->skipAuthorization();

            if (!$user) {
                return $this->redirect(['controller' => 'Frontend', 'action' => 'login']);
            }

            // Obtener el chofer del usuario autenticado
            $choferesTable = $this->fetchTable('XservChoferes');
            $chofer = $choferesTable->find()
                ->where(['usuario_id' => $user->id])
                ->first();

            if (!$chofer) {
                $this->Flash->error('No hay perfil de chofer asociado a tu usuario.');
                return $this->redirect(['action' => 'choferPanel']);
            }

            // Usar layout frontend para eliminar la interfaz de CakePHP
            $this->viewBuilder()->setLayout('frontend');
            
            // Renderizar la vista de viajes
            $this->set(compact('user', 'chofer'));
            $this->render('chofer_trips');
        }

    /**
     * API: Aceptar asignación
     */
    public function acceptAsignacion(?int $id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post']);
        
        try {
            $user = $this->Authentication->getIdentity();
            if (!$user || $user->rol !== 'chofer') {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode(['success' => false, 'message' => 'No autorizado']))
                    ->withStatus(403);
            }

            if (!$id) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode(['success' => false, 'message' => 'ID de asignación requerido']))
                    ->withStatus(400);
            }

            $choferesTable = $this->fetchTable('XservChoferes');
            $chofer = $choferesTable->find()
                ->where(['usuario_id' => $user->id])
                ->first();

            if (!$chofer) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode(['success' => false, 'message' => 'Chofer no encontrado']))
                    ->withStatus(404);
            }

            $asignacionesTable = $this->fetchTable('XservAsignaciones');
            $asignacion = $asignacionesTable->get($id);

            if (!$asignacion) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode(['success' => false, 'message' => 'Asignación no encontrada']))
                    ->withStatus(404);
            }

            if ($asignacion->chofer_id !== $chofer->id) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode(['success' => false, 'message' => 'Esta asignación no te pertenece']))
                    ->withStatus(403);
            }

            $asignacion->estado_asignacion = 'en_curso';

            if ($asignacionesTable->save($asignacion)) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode(['success' => true, 'message' => 'Asignación aceptada', 'data' => $asignacion]))
                    ->withStatus(200);
            } else {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode(['success' => false, 'message' => 'Error al aceptar asignación']))
                    ->withStatus(500);
            }
        } catch (\Exception $e) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Error interno: ' . $e->getMessage()]))
                ->withStatus(500);
        }
    }

    /**
     * API: Rechazar asignación
     */
    public function declineAsignacion(?int $id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post']);
        
        try {
            $user = $this->Authentication->getIdentity();
            if (!$user || $user->rol !== 'chofer') {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode(['success' => false, 'message' => 'No autorizado']))
                    ->withStatus(403);
            }

            if (!$id) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode(['success' => false, 'message' => 'ID de asignación requerido']))
                    ->withStatus(400);
            }

            $choferesTable = $this->fetchTable('XservChoferes');
            $chofer = $choferesTable->find()
                ->where(['usuario_id' => $user->id])
                ->first();

            if (!$chofer) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode(['success' => false, 'message' => 'Chofer no encontrado']))
                    ->withStatus(404);
            }

            $asignacionesTable = $this->fetchTable('XservAsignaciones');
            $asignacion = $asignacionesTable->get($id);

            if (!$asignacion) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode(['success' => false, 'message' => 'Asignación no encontrada']))
                    ->withStatus(404);
            }

            if ($asignacion->chofer_id !== $chofer->id) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode(['success' => false, 'message' => 'Esta asignación no te pertenece']))
                    ->withStatus(403);
            }

            $asignacion->estado_asignacion = 'cancelada';

            if ($asignacionesTable->save($asignacion)) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode(['success' => true, 'message' => 'Asignación rechazada', 'data' => $asignacion]))
                    ->withStatus(200);
            } else {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode(['success' => false, 'message' => 'Error al rechazar asignación']))
                    ->withStatus(500);
            }
        } catch (\Exception $e) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'message' => 'Error interno: ' . $e->getMessage()]))
                ->withStatus(500);
        }
    }

    /**
     * Aceptar asignación (nueva versión simplificada)
     */
    public function aceptarAsignacion($id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post']);
        $this->autoRender = false;
        
        $response = ['success' => false, 'message' => ''];
        
        // Obtener usuario autenticado
        $user = $this->Authentication->getIdentity();
        if (!$user) {
            $response['message'] = 'Usuario no autenticado';
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($response))
                ->withStatus(401);
        }
        
        // Obtener chofer
        $choferesTable = $this->fetchTable('XservChoferes');
        $chofer = $choferesTable->find()
            ->where(['usuario_id' => $user->id])
            ->first();
            
        if (!$chofer) {
            $response['message'] = 'Chofer no encontrado';
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($response))
                ->withStatus(404);
        }
        
        // Obtener asignación
        $asignacionesTable = $this->fetchTable('XservAsignaciones');
        $asignacion = $asignacionesTable->find()
            ->where([
                'id' => $id,
                'chofer_id' => $chofer->id
            ])
            ->first();
            
        if (!$asignacion) {
            $response['message'] = 'Asignación no encontrada o no autorizada';
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($response))
                ->withStatus(404);
        }
        
        // Cambiar estado
        $asignacion->estado_asignacion = 'en_curso';
        
        if ($asignacionesTable->save($asignacion)) {
            $response['success'] = true;
            $response['message'] = 'Asignación aceptada correctamente';
            $response['asignacion'] = [
                'id' => $asignacion->id,
                'estado' => $asignacion->estado_asignacion
            ];
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($response))
                ->withStatus(200);
        } else {
            $response['message'] = 'Error al guardar la asignación';
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($response))
                ->withStatus(500);
        }
    }
    
    /**
     * Rechazar asignación (nueva versión simplificada)
     */
    public function rechazarAsignacion($id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post']);
        $this->autoRender = false;
        
        $response = ['success' => false, 'message' => ''];
        
        // Obtener usuario autenticado
        $user = $this->Authentication->getIdentity();
        if (!$user) {
            $response['message'] = 'Usuario no autenticado';
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($response))
                ->withStatus(401);
        }
        
        // Obtener chofer
        $choferesTable = $this->fetchTable('XservChoferes');
        $chofer = $choferesTable->find()
            ->where(['usuario_id' => $user->id])
            ->first();
            
        if (!$chofer) {
            $response['message'] = 'Chofer no encontrado';
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($response))
                ->withStatus(404);
        }
        
        // Obtener asignación
        $asignacionesTable = $this->fetchTable('XservAsignaciones');
        $asignacion = $asignacionesTable->find()
            ->where([
                'id' => $id,
                'chofer_id' => $chofer->id
            ])
            ->first();
            
        if (!$asignacion) {
            $response['message'] = 'Asignación no encontrada o no autorizada';
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($response))
                ->withStatus(404);
        }
        
        // Cambiar estado
        $asignacion->estado_asignacion = 'cancelada';
        
        if ($asignacionesTable->save($asignacion)) {
            $response['success'] = true;
            $response['message'] = 'Asignación rechazada correctamente';
            $response['asignacion'] = [
                'id' => $asignacion->id,
                'estado' => $asignacion->estado_asignacion
            ];
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($response))
                ->withStatus(200);
        } else {
            $response['message'] = 'Error al guardar la asignación';
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($response))
                ->withStatus(500);
        }
    }
}

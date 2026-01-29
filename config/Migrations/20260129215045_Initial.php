<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class Initial extends BaseMigration
{
    /**
     * Up Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-up-method
     *
     * @return void
     */
    public function up(): void
    {
        $this->table('xserv_asignaciones')
            ->addColumn('reserva_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('chofer_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('vehiculo_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('asignado_por_id', 'integer', [
                'comment' => 'ID del admin/operador que hizo la asignación',
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('fecha_inicio_pactada', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('fecha_fin_pactada', 'datetime', [
                'comment' => 'Hora estimada de liberación del recurso',
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('estado_asignacion', 'string', [
                'default' => 'programada',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('observaciones_chofer', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                $this->index('reserva_id')
                    ->setName('reserva_id')
            )
            ->addIndex(
                $this->index('vehiculo_id')
                    ->setName('vehiculo_id')
            )
            ->addIndex(
                $this->index('asignado_por_id')
                    ->setName('asignado_por_id')
            )
            ->addIndex(
                $this->index([
                        'chofer_id',
                        'estado_asignacion',
                    ])
                    ->setName('idx_asignaciones_chofer_estado')
            )
            ->addIndex(
                $this->index([
                        'fecha_inicio_pactada',
                        'fecha_fin_pactada',
                    ])
                    ->setName('idx_agenda_tiempo')
            )
            ->create();

        $this->table('xserv_choferes')
            ->addColumn('usuario_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('nombre', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('identificacion', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('telefono', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('correo', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('estado', 'string', [
                'default' => 'activo',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('fecha_ingreso', 'date', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('tipo_licencia', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('disponibilidad', 'string', [
                'default' => 'disponible',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                $this->index('identificacion')
                    ->setName('identificacion')
                    ->setType('unique')
            )
            ->addIndex(
                $this->index('usuario_id')
                    ->setName('usuario_id')
            )
            ->create();

        $this->table('xserv_clientes')
            ->addColumn('nombre', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('identificacion_fiscal', 'string', [
                'comment' => 'Cédula o Pasaporte',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('correo', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('telefono', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('direccion_facturacion', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('idioma_preferido', 'string', [
                'default' => 'es',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                $this->index('identificacion_fiscal')
                    ->setName('idx_clientes_id_fiscal')
            )
            ->create();

        $this->table('xserv_configuraciones')
            ->addColumn('clave', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('valor', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('tipo_dato', 'string', [
                'default' => 'string',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('grupo', 'string', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('descripcion_parametro', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('editable_por_admin', 'boolean', [
                'default' => true,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                $this->index('clave')
                    ->setName('clave')
                    ->setType('unique')
            )
            ->create();

        $this->table('xserv_destinos')
            ->addColumn('ubicacion_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('descripcion_es', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('descripcion_en', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('es_popular', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                $this->index('ubicacion_id')
                    ->setName('ubicacion_id')
            )
            ->create();

        $this->table('xserv_ejecucion_viajes')
            ->addColumn('asignacion_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('hora_inicio_real', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('hora_fin_real', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('km_inicio', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('km_fin', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('lat_inicio', 'decimal', [
                'default' => null,
                'null' => true,
                'precision' => 10,
                'scale' => 8,
                'signed' => true,
            ])
            ->addColumn('lng_inicio', 'decimal', [
                'default' => null,
                'null' => true,
                'precision' => 11,
                'scale' => 8,
                'signed' => true,
            ])
            ->addColumn('lat_fin', 'decimal', [
                'default' => null,
                'null' => true,
                'precision' => 10,
                'scale' => 8,
                'signed' => true,
            ])
            ->addColumn('lng_fin', 'decimal', [
                'default' => null,
                'null' => true,
                'precision' => 11,
                'scale' => 8,
                'signed' => true,
            ])
            ->addColumn('estado_ejecucion', 'string', [
                'default' => 'en_espera',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('observaciones_finales', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                $this->index('asignacion_id')
                    ->setName('asignacion_id')
            )
            ->create();

        $this->table('xserv_incidencias_viaje')
            ->addColumn('ejecucion_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('tipo_incidencia', 'string', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('descripcion', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('latitud_incidencia', 'decimal', [
                'default' => null,
                'null' => true,
                'precision' => 10,
                'scale' => 8,
                'signed' => true,
            ])
            ->addColumn('longitud_incidencia', 'decimal', [
                'default' => null,
                'null' => true,
                'precision' => 11,
                'scale' => 8,
                'signed' => true,
            ])
            ->addColumn('severidad', 'string', [
                'default' => 'baja',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('resuelto', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                $this->index('ejecucion_id')
                    ->setName('ejecucion_id')
            )
            ->create();

        $this->table('xserv_notificaciones')
            ->addColumn('usuario_id', 'integer', [
                'comment' => 'Referencia a xserv_usuarios si tiene cuenta',
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('cliente_id', 'integer', [
                'comment' => 'Referencia a xserv_clientes si es externo',
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('reserva_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('tipo_notificacion', 'string', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('medio', 'string', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('destinatario', 'string', [
                'comment' => 'Correo o Teléfono al que se envió',
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('contenido', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('estado_envio', 'string', [
                'default' => 'pendiente',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('error_log', 'text', [
                'comment' => 'Captura el error de la API si falla',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('enviado_at', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                $this->index('usuario_id')
                    ->setName('usuario_id')
            )
            ->addIndex(
                $this->index('cliente_id')
                    ->setName('cliente_id')
            )
            ->addIndex(
                $this->index('reserva_id')
                    ->setName('reserva_id')
            )
            ->create();

        $this->table('xserv_reservas')
            ->addColumn('codigo_reserva', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('cliente_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('servicio_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('ruta_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('fecha', 'date', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('hora', 'time', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('pasajeros', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('precio_pactado', 'decimal', [
                'default' => null,
                'null' => false,
                'precision' => 10,
                'scale' => 2,
                'signed' => true,
            ])
            ->addColumn('itbms_pactado', 'decimal', [
                'default' => '0.07',
                'null' => true,
                'precision' => 10,
                'scale' => 2,
                'signed' => true,
            ])
            ->addColumn('punto_recogida', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('punto_destino', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('observaciones', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('estado', 'string', [
                'default' => 'pendiente',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('estado_pago', 'string', [
                'default' => 'pendiente',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                $this->index('codigo_reserva')
                    ->setName('codigo_reserva')
                    ->setType('unique')
            )
            ->addIndex(
                $this->index('cliente_id')
                    ->setName('cliente_id')
            )
            ->addIndex(
                $this->index('servicio_id')
                    ->setName('servicio_id')
            )
            ->addIndex(
                $this->index('ruta_id')
                    ->setName('fk_reserva_ruta')
            )
            ->addIndex(
                $this->index([
                        'fecha',
                        'estado',
                    ])
                    ->setName('idx_reservas_operativo')
            )
            ->create();

        $this->table('xserv_rutas')
            ->addColumn('origen_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('destino_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('precio_base', 'decimal', [
                'default' => null,
                'null' => false,
                'precision' => 10,
                'scale' => 2,
                'signed' => true,
            ])
            ->addColumn('tiempo_estimado_min', 'integer', [
                'comment' => 'Para cálculos de disponibilidad',
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addIndex(
                $this->index('origen_id')
                    ->setName('origen_id')
            )
            ->addIndex(
                $this->index('destino_id')
                    ->setName('destino_id')
            )
            ->create();

        $this->table('xserv_servicios')
            ->addColumn('nombre', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('descripcion_es', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('descripcion_en', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('precio_base', 'decimal', [
                'default' => null,
                'null' => false,
                'precision' => 10,
                'scale' => 2,
                'signed' => true,
            ])
            ->addColumn('variantes', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('estado', 'string', [
                'default' => 'activo',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('xserv_servicios_destinos', ['id' => false, 'primary_key' => ['servicio_id', 'destino_id']])
            ->addColumn('servicio_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('destino_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('orden_visita', 'integer', [
                'default' => '1',
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addIndex(
                $this->index('destino_id')
                    ->setName('destino_id')
            )
            ->create();

        $this->table('xserv_ubicaciones')
            ->addColumn('nombre', 'string', [
                'default' => null,
                'limit' => 150,
                'null' => false,
            ])
            ->addColumn('EN_PROVINCIAS', 'string', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('direccion_gps', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('xserv_usuarios')
            ->addColumn('username', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('rol', 'string', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('estado', 'string', [
                'default' => 'activo',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                $this->index('username')
                    ->setName('username')
                    ->setType('unique')
            )
            ->addIndex(
                $this->index([
                        'username',
                        'estado',
                    ])
                    ->setName('idx_usuarios_auth')
            )
            ->create();

        $this->table('xserv_valoraciones')
            ->addColumn('reserva_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('calificacion', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('puntuacion_limpieza', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('puntuacion_puntualidad', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('comentarios', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('mostrar_en_web', 'boolean', [
                'default' => true,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('estado_moderacion', 'string', [
                'default' => 'pendiente',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                $this->index('reserva_id')
                    ->setName('reserva_id')
                    ->setType('unique')
            )
            ->create();

        $this->table('xserv_vehiculos')
            ->addColumn('tipo', 'string', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('nombre_unidad', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('capacidad_max', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('placa', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('anio', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('kilometraje_actual', 'integer', [
                'default' => '0',
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('estado_operativo', 'string', [
                'default' => 'disponible',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                $this->index('placa')
                    ->setName('placa')
                    ->setType('unique')
            )
            ->create();

        $this->table('xserv_asignaciones')
            ->addForeignKey(
                $this->foreignKey('reserva_id')
                    ->setReferencedTable('xserv_reservas')
                    ->setReferencedColumns('id')
                    ->setOnDelete('CASCADE')
                    ->setOnUpdate('RESTRICT')
                    ->setName('xserv_asignaciones_ibfk_1')
            )
            ->addForeignKey(
                $this->foreignKey('asignado_por_id')
                    ->setReferencedTable('xserv_usuarios')
                    ->setReferencedColumns('id')
                    ->setOnDelete('RESTRICT')
                    ->setOnUpdate('RESTRICT')
                    ->setName('xserv_asignaciones_ibfk_4')
            )
            ->addForeignKey(
                $this->foreignKey('vehiculo_id')
                    ->setReferencedTable('xserv_vehiculos')
                    ->setReferencedColumns('id')
                    ->setOnDelete('RESTRICT')
                    ->setOnUpdate('RESTRICT')
                    ->setName('xserv_asignaciones_ibfk_3')
            )
            ->addForeignKey(
                $this->foreignKey('chofer_id')
                    ->setReferencedTable('xserv_choferes')
                    ->setReferencedColumns('id')
                    ->setOnDelete('RESTRICT')
                    ->setOnUpdate('RESTRICT')
                    ->setName('xserv_asignaciones_ibfk_2')
            )
            ->update();

        $this->table('xserv_choferes')
            ->addForeignKey(
                $this->foreignKey('usuario_id')
                    ->setReferencedTable('xserv_usuarios')
                    ->setReferencedColumns('id')
                    ->setOnDelete('SET_NULL')
                    ->setOnUpdate('RESTRICT')
                    ->setName('xserv_choferes_ibfk_1')
            )
            ->update();

        $this->table('xserv_destinos')
            ->addForeignKey(
                $this->foreignKey('ubicacion_id')
                    ->setReferencedTable('xserv_ubicaciones')
                    ->setReferencedColumns('id')
                    ->setOnDelete('CASCADE')
                    ->setOnUpdate('RESTRICT')
                    ->setName('xserv_destinos_ibfk_1')
            )
            ->update();

        $this->table('xserv_ejecucion_viajes')
            ->addForeignKey(
                $this->foreignKey('asignacion_id')
                    ->setReferencedTable('xserv_asignaciones')
                    ->setReferencedColumns('id')
                    ->setOnDelete('CASCADE')
                    ->setOnUpdate('RESTRICT')
                    ->setName('xserv_ejecucion_viajes_ibfk_1')
            )
            ->update();

        $this->table('xserv_incidencias_viaje')
            ->addForeignKey(
                $this->foreignKey('ejecucion_id')
                    ->setReferencedTable('xserv_ejecucion_viajes')
                    ->setReferencedColumns('id')
                    ->setOnDelete('CASCADE')
                    ->setOnUpdate('RESTRICT')
                    ->setName('xserv_incidencias_viaje_ibfk_1')
            )
            ->update();

        $this->table('xserv_notificaciones')
            ->addForeignKey(
                $this->foreignKey('reserva_id')
                    ->setReferencedTable('xserv_reservas')
                    ->setReferencedColumns('id')
                    ->setOnDelete('CASCADE')
                    ->setOnUpdate('RESTRICT')
                    ->setName('xserv_notificaciones_ibfk_3')
            )
            ->addForeignKey(
                $this->foreignKey('cliente_id')
                    ->setReferencedTable('xserv_clientes')
                    ->setReferencedColumns('id')
                    ->setOnDelete('SET_NULL')
                    ->setOnUpdate('RESTRICT')
                    ->setName('xserv_notificaciones_ibfk_2')
            )
            ->addForeignKey(
                $this->foreignKey('usuario_id')
                    ->setReferencedTable('xserv_usuarios')
                    ->setReferencedColumns('id')
                    ->setOnDelete('SET_NULL')
                    ->setOnUpdate('RESTRICT')
                    ->setName('xserv_notificaciones_ibfk_1')
            )
            ->update();

        $this->table('xserv_reservas')
            ->addForeignKey(
                $this->foreignKey('servicio_id')
                    ->setReferencedTable('xserv_servicios')
                    ->setReferencedColumns('id')
                    ->setOnDelete('RESTRICT')
                    ->setOnUpdate('RESTRICT')
                    ->setName('xserv_reservas_ibfk_2')
            )
            ->addForeignKey(
                $this->foreignKey('cliente_id')
                    ->setReferencedTable('xserv_clientes')
                    ->setReferencedColumns('id')
                    ->setOnDelete('CASCADE')
                    ->setOnUpdate('RESTRICT')
                    ->setName('xserv_reservas_ibfk_1')
            )
            ->addForeignKey(
                $this->foreignKey('ruta_id')
                    ->setReferencedTable('xserv_rutas')
                    ->setReferencedColumns('id')
                    ->setOnDelete('RESTRICT')
                    ->setOnUpdate('RESTRICT')
                    ->setName('fk_reserva_ruta')
            )
            ->update();

        $this->table('xserv_rutas')
            ->addForeignKey(
                $this->foreignKey('destino_id')
                    ->setReferencedTable('xserv_ubicaciones')
                    ->setReferencedColumns('id')
                    ->setOnDelete('RESTRICT')
                    ->setOnUpdate('RESTRICT')
                    ->setName('xserv_rutas_ibfk_2')
            )
            ->addForeignKey(
                $this->foreignKey('origen_id')
                    ->setReferencedTable('xserv_ubicaciones')
                    ->setReferencedColumns('id')
                    ->setOnDelete('RESTRICT')
                    ->setOnUpdate('RESTRICT')
                    ->setName('xserv_rutas_ibfk_1')
            )
            ->update();

        $this->table('xserv_servicios_destinos')
            ->addForeignKey(
                $this->foreignKey('destino_id')
                    ->setReferencedTable('xserv_destinos')
                    ->setReferencedColumns('id')
                    ->setOnDelete('CASCADE')
                    ->setOnUpdate('RESTRICT')
                    ->setName('xserv_servicios_destinos_ibfk_2')
            )
            ->addForeignKey(
                $this->foreignKey('servicio_id')
                    ->setReferencedTable('xserv_servicios')
                    ->setReferencedColumns('id')
                    ->setOnDelete('CASCADE')
                    ->setOnUpdate('RESTRICT')
                    ->setName('xserv_servicios_destinos_ibfk_1')
            )
            ->update();

        $this->table('xserv_valoraciones')
            ->addForeignKey(
                $this->foreignKey('reserva_id')
                    ->setReferencedTable('xserv_reservas')
                    ->setReferencedColumns('id')
                    ->setOnDelete('CASCADE')
                    ->setOnUpdate('RESTRICT')
                    ->setName('xserv_valoraciones_ibfk_1')
            )
            ->update();
    }

    /**
     * Down Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-down-method
     *
     * @return void
     */
    public function down(): void
    {
        $this->table('xserv_asignaciones')
            ->dropForeignKey(
                'reserva_id'
            )
            ->dropForeignKey(
                'asignado_por_id'
            )
            ->dropForeignKey(
                'vehiculo_id'
            )
            ->dropForeignKey(
                'chofer_id'
            )->save();

        $this->table('xserv_choferes')
            ->dropForeignKey(
                'usuario_id'
            )->save();

        $this->table('xserv_destinos')
            ->dropForeignKey(
                'ubicacion_id'
            )->save();

        $this->table('xserv_ejecucion_viajes')
            ->dropForeignKey(
                'asignacion_id'
            )->save();

        $this->table('xserv_incidencias_viaje')
            ->dropForeignKey(
                'ejecucion_id'
            )->save();

        $this->table('xserv_notificaciones')
            ->dropForeignKey(
                'reserva_id'
            )
            ->dropForeignKey(
                'cliente_id'
            )
            ->dropForeignKey(
                'usuario_id'
            )->save();

        $this->table('xserv_reservas')
            ->dropForeignKey(
                'servicio_id'
            )
            ->dropForeignKey(
                'cliente_id'
            )
            ->dropForeignKey(
                'ruta_id'
            )->save();

        $this->table('xserv_rutas')
            ->dropForeignKey(
                'destino_id'
            )
            ->dropForeignKey(
                'origen_id'
            )->save();

        $this->table('xserv_servicios_destinos')
            ->dropForeignKey(
                'destino_id'
            )
            ->dropForeignKey(
                'servicio_id'
            )->save();

        $this->table('xserv_valoraciones')
            ->dropForeignKey(
                'reserva_id'
            )->save();

        $this->table('xserv_asignaciones')->drop()->save();
        $this->table('xserv_choferes')->drop()->save();
        $this->table('xserv_clientes')->drop()->save();
        $this->table('xserv_configuraciones')->drop()->save();
        $this->table('xserv_destinos')->drop()->save();
        $this->table('xserv_ejecucion_viajes')->drop()->save();
        $this->table('xserv_incidencias_viaje')->drop()->save();
        $this->table('xserv_notificaciones')->drop()->save();
        $this->table('xserv_reservas')->drop()->save();
        $this->table('xserv_rutas')->drop()->save();
        $this->table('xserv_servicios')->drop()->save();
        $this->table('xserv_servicios_destinos')->drop()->save();
        $this->table('xserv_ubicaciones')->drop()->save();
        $this->table('xserv_usuarios')->drop()->save();
        $this->table('xserv_valoraciones')->drop()->save();
        $this->table('xserv_vehiculos')->drop()->save();
    }
}

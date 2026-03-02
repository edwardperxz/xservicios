<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservAsignacione[]|\Cake\Collection\CollectionInterface $asignaciones
 * @var \App\Model\Entity\XservChofere $chofer
 */
$this->assign('title', 'Mis Servicios - Xservicios');
?>

<style>
    .chofer-header {
        background: linear-gradient(135deg, var(--dark-card) 0%, var(--dark-lighter) 100%);
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        border: 1px solid rgba(201, 169, 98, 0.1);
    }

    .chofer-header h1 {
        color: var(--text-white);
        margin-bottom: 0.5rem;
        font-size: 1.75rem;
    }

    .chofer-subtitle {
        color: var(--text-gray);
        font-size: 1rem;
    }

    .servicios-grid {
        display: grid;
        gap: 1.5rem;
    }

    .servicio-card {
        background: var(--dark-card);
        border: 1px solid rgba(201, 169, 98, 0.1);
        border-radius: 12px;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }

    .servicio-card:hover {
        border-color: var(--gold);
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.3);
    }

    .servicio-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(201, 169, 98, 0.1);
    }

    .servicio-info h3 {
        color: var(--gold);
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }

    .codigo-reserva {
        color: var(--text-gray);
        font-size: 0.875rem;
        font-family: 'Courier New', monospace;
    }

    .estado-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
        display: inline-block;
    }

    .estado-programada { background: rgba(59, 130, 246, 0.2); color: var(--blue); }
    .estado-en_curso { background: rgba(74, 222, 128, 0.2); color: var(--green); }
    .estado-finalizada { background: rgba(160, 160, 160, 0.2); color: var(--text-gray); }
    .estado-cancelada { background: rgba(239, 68, 68, 0.2); color: var(--red); }

    .servicio-detalles {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .detalle-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .detalle-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: rgba(201, 169, 98, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gold);
    }

    .detalle-icon svg {
        width: 20px;
        height: 20px;
    }

    .detalle-content strong {
        display: block;
        color: var(--text-white);
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }

    .detalle-content span {
        color: var(--text-gray);
        font-size: 0.8125rem;
    }

    .servicio-acciones {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9375rem;
    }

    .btn svg {
        width: 18px;
        height: 18px;
    }

    .btn-primary {
        background: var(--gold);
        color: var(--dark-bg);
    }

    .btn-primary:hover {
        background: var(--gold-light);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(201, 169, 98, 0.3);
    }

    .btn-danger {
        background: var(--red);
        color: white;
    }

    .btn-danger:hover {
        background: #dc2626;
        transform: translateY(-2px);
    }

    .btn-success {
        background: var(--green);
        color: var(--dark-bg);
    }

    .btn-success:hover {
        background: #22c55e;
        transform: translateY(-2px);
    }

    .btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none !important;
    }

    .ejecucion-info {
        background: rgba(201, 169, 98, 0.05);
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
    }

    .ejecucion-info h4 {
        color: var(--gold);
        font-size: 1rem;
        margin-bottom: 0.75rem;
    }

    .ejecucion-datos {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 0.75rem;
        color: var(--text-gray);
        font-size: 0.875rem;
    }

    .incidencias-list {
        background: rgba(239, 68, 68, 0.05);
        padding: 1rem;
        border-radius: 8px;
        margin-top: 1rem;
    }

    .incidencia-item {
        padding: 0.75rem;
        background: var(--dark-lighter);
        border-radius: 6px;
        margin-bottom: 0.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .incidencia-item:last-child {
        margin-bottom: 0;
    }

    .severidad-baja { border-left: 3px solid var(--blue); }
    .severidad-media { border-left: 3px solid var(--orange); }
    .severidad-alta { border-left: 3px solid var(--red); }
    .severidad-critica { border-left: 3px solid #dc2626; }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--text-gray);
    }

    .empty-state svg {
        width: 80px;
        height: 80px;
        margin-bottom: 1.5rem;
        color: var(--gold);
        opacity: 0.3;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.8);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .modal.active {
        display: flex;
    }

    .modal-content {
        background: var(--dark-card);
        border: 1px solid rgba(201, 169, 98, 0.2);
        border-radius: 12px;
        padding: 2rem;
        max-width: 500px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .modal-header h3 {
        color: var(--gold);
        font-size: 1.5rem;
    }

    .modal-close {
        background: none;
        border: none;
        color: var(--text-gray);
        cursor: pointer;
        padding: 0.5rem;
        transition: color 0.3s;
    }

    .modal-close:hover {
        color: var(--text-white);
    }

    .modal-close svg {
        width: 24px;
        height: 24px;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        color: var(--text-white);
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 0.9375rem;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 0.875rem;
        background: var(--dark-lighter);
        border: 1px solid rgba(201, 169, 98, 0.2);
        border-radius: 8px;
        color: var(--text-white);
        font-size: 0.9375rem;
        transition: border-color 0.3s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--gold);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
    }

    .btn-secondary {
        background: var(--dark-lighter);
        color: var(--text-white);
    }

    .btn-secondary:hover {
        background: #3a3a3a;
    }

    @media (max-width: 768px) {
        .servicio-header {
            flex-direction: column;
            gap: 1rem;
        }

        .servicio-detalles {
            grid-template-columns: 1fr;
        }

        .servicio-acciones {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="chofer-header">
    <h1>Mis Servicios Asignados</h1>
    <p class="chofer-subtitle">Gestiona tus viajes y reporta incidencias en tiempo real</p>
</div>

<?php if ($asignaciones->count() > 0): ?>
    <div class="servicios-grid">
        <?php foreach ($asignaciones as $asignacion): ?>
            <?php 
                $ejecucion = !empty($asignacion->xserv_ejecucion_viajes) ? $asignacion->xserv_ejecucion_viajes[0] : null;
                $tieneEjecucion = $ejecucion !== null;
                $enProgreso = $tieneEjecucion && $ejecucion->estado_ejecucion === 'en_progreso';
                $completado = $tieneEjecucion && $ejecucion->estado_ejecucion === 'completado';
            ?>
            <div class="servicio-card">
                <div class="servicio-header">
                    <div class="servicio-info">
                        <h3><?= h($asignacion->reserva->xserv_servicio->nombre) ?></h3>
                        <div class="codigo-reserva">Reserva: <?= h($asignacion->reserva->codigo_reserva) ?></div>
                    </div>
                    <span class="estado-badge estado-<?= h($asignacion->estado_asignacion) ?>">
                        <?= ucfirst(str_replace('_', ' ', h($asignacion->estado_asignacion))) ?>
                    </span>
                </div>

                <div class="servicio-detalles">
                    <div class="detalle-item">
                        <div class="detalle-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="detalle-content">
                            <strong>Fecha</strong>
                            <span><?= $asignacion->fecha_inicio_pactada->format('d/m/Y H:i') ?></span>
                        </div>
                    </div>

                    <div class="detalle-item">
                        <div class="detalle-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                        </div>
                        <div class="detalle-content">
                            <strong>Vehículo</strong>
                            <span><?= h($asignacion->vehiculo->placa) ?> - <?= h($asignacion->vehiculo->nombre_unidad ?? 'N/A') ?></span>
                        </div>
                    </div>

                    <div class="detalle-item">
                        <div class="detalle-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div class="detalle-content">
                            <strong>Pasajeros</strong>
                            <span><?= h($asignacion->reserva->pasajeros) ?> personas</span>
                        </div>
                    </div>

                    <div class="detalle-item">
                        <div class="detalle-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div class="detalle-content">
                            <strong>Recogida</strong>
                            <span><?= h($asignacion->reserva->punto_recogida) ?></span>
                        </div>
                    </div>
                </div>

                <?php if ($tieneEjecucion): ?>
                    <div class="ejecucion-info">
                        <h4>Información del Viaje</h4>
                        <div class="ejecucion-datos">
                            <div><strong>Estado:</strong> <?= ucfirst(str_replace('_', ' ', h($ejecucion->estado_ejecucion))) ?></div>
                            <div><strong>Inicio:</strong> <?= $ejecucion->hora_inicio_real ? $ejecucion->hora_inicio_real->format('H:i') : 'N/A' ?></div>
                            <div><strong>KM Inicial:</strong> <?= h($ejecucion->km_inicio) ?></div>
                            <?php if ($completado): ?>
                                <div><strong>Fin:</strong> <?= $ejecucion->hora_fin_real ? $ejecucion->hora_fin_real->format('H:i') : 'N/A' ?></div>
                                <div><strong>KM Final:</strong> <?= h($ejecucion->km_fin) ?></div>
                                <div><strong>KM Recorridos:</strong> <?= h($ejecucion->km_fin - $ejecucion->km_inicio) ?></div>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($ejecucion->xserv_incidencias_viaje)): ?>
                            <div class="incidencias-list">
                                <h4>Incidencias Reportadas</h4>
                                <?php foreach ($ejecucion->xserv_incidencias_viaje as $incidencia): ?>
                                    <div class="incidencia-item severidad-<?= h($incidencia->severidad) ?>">
                                        <div>
                                            <strong><?= ucfirst(h($incidencia->tipo_incidencia)) ?></strong> - 
                                            <?= ucfirst(h($incidencia->severidad)) ?>
                                            <?php if ($incidencia->resuelto): ?>
                                                <span style="color: var(--green);">✓ Resuelta</span>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (!$incidencia->resuelto): ?>
                                            <button class="btn btn-success btn-sm" onclick="resolverIncidencia(<?= $incidencia->id ?>)">
                                                Resolver
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="servicio-acciones">
                    <?php if (!$tieneEjecucion && $asignacion->estado_asignacion === 'programada'): ?>
                        <button class="btn btn-primary" onclick="abrirModalIniciar(<?= $asignacion->id ?>)">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Iniciar Servicio
                        </button>
                    <?php endif; ?>

                    <?php if ($enProgreso): ?>
                        <button class="btn btn-danger" onclick="abrirModalIncidencia(<?= $ejecucion->id ?>)">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            Reportar Incidencia
                        </button>

                        <button class="btn btn-success" onclick="abrirModalFinalizar(<?= $ejecucion->id ?>)">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Finalizar Servicio
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="empty-state">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
        </svg>
        <h2>No tienes servicios asignados</h2>
        <p>Cuando te asignen un servicio, aparecerá aquí</p>
    </div>
<?php endif; ?>

<!-- Modal Iniciar Servicio -->
<div id="modalIniciar" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Iniciar Servicio</h3>
            <button class="modal-close" onclick="cerrarModal('modalIniciar')">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="formIniciar" onsubmit="iniciarServicio(event)">
            <input type="hidden" id="asignacion_id" name="asignacion_id">
            
            <div class="form-group">
                <label for="km_inicio">Kilometraje Inicial *</label>
                <input type="number" id="km_inicio" name="km_inicio" required min="0" step="1">
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="cerrarModal('modalIniciar')">Cancelar</button>
                <button type="submit" class="btn btn-primary">Iniciar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Finalizar Servicio -->
<div id="modalFinalizar" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Finalizar Servicio</h3>
            <button class="modal-close" onclick="cerrarModal('modalFinalizar')">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="formFinalizar" onsubmit="finalizarServicio(event)">
            <input type="hidden" id="ejecucion_id_finalizar" name="ejecucion_id">
            
            <div class="form-group">
                <label for="km_fin">Kilometraje Final *</label>
                <input type="number" id="km_fin" name="km_fin" required min="0" step="1">
            </div>

            <div class="form-group">
                <label for="observaciones_finales">Observaciones (Opcional)</label>
                <textarea id="observaciones_finales" name="observaciones_finales" placeholder="Escribe aquí cualquier observación sobre el servicio..."></textarea>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="cerrarModal('modalFinalizar')">Cancelar</button>
                <button type="submit" class="btn btn-success">Finalizar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Reportar Incidencia -->
<div id="modalIncidencia" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Reportar Incidencia</h3>
            <button class="modal-close" onclick="cerrarModal('modalIncidencia')">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="formIncidencia" onsubmit="reportarIncidencia(event)">
            <input type="hidden" id="ejecucion_id_incidencia" name="ejecucion_id">
            
            <div class="form-group">
                <label for="tipo_incidencia">Tipo de Incidencia *</label>
                <select id="tipo_incidencia" name="tipo_incidencia" required>
                    <option value="">Selecciona un tipo</option>
                    <option value="mecanica">Mecánica</option>
                    <option value="trafico">Tráfico</option>
                    <option value="clima">Clima</option>
                    <option value="cliente">Cliente</option>
                    <option value="otros">Otros</option>
                </select>
            </div>

            <div class="form-group">
                <label for="severidad">Severidad *</label>
                <select id="severidad" name="severidad" required>
                    <option value="baja">Baja</option>
                    <option value="media">Media</option>
                    <option value="alta">Alta</option>
                    <option value="critica">Crítica</option>
                </select>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción (Opcional)</label>
                <textarea id="descripcion" name="descripcion" placeholder="Describe la incidencia..."></textarea>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="cerrarModal('modalIncidencia')">Cancelar</button>
                <button type="submit" class="btn btn-danger">Reportar</button>
            </div>
        </form>
    </div>
</div>

<script>
function abrirModalIniciar(asignacionId) {
    document.getElementById('asignacion_id').value = asignacionId;
    document.getElementById('modalIniciar').classList.add('active');
}

function abrirModalFinalizar(ejecucionId) {
    document.getElementById('ejecucion_id_finalizar').value = ejecucionId;
    document.getElementById('modalFinalizar').classList.add('active');
}

function abrirModalIncidencia(ejecucionId) {
    document.getElementById('ejecucion_id_incidencia').value = ejecucionId;
    document.getElementById('modalIncidencia').classList.add('active');
}

function cerrarModal(modalId) {
    document.getElementById(modalId).classList.remove('active');
}

function obtenerUbicacion() {
    return new Promise((resolve, reject) => {
        if (!navigator.geolocation) {
            reject(new Error('Geolocalización no disponible'));
            return;
        }

        navigator.geolocation.getCurrentPosition(
            (position) => {
                resolve({
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                });
            },
            (error) => {
                reject(error);
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    });
}

async function iniciarServicio(event) {
    event.preventDefault();
    
    try {
        const ubicacion = await obtenerUbicacion();
        const formData = new FormData(event.target);
        
        const data = {
            asignacion_id: formData.get('asignacion_id'),
            km_inicio: formData.get('km_inicio'),
            lat_inicio: ubicacion.lat,
            lng_inicio: ubicacion.lng
        };

        const response = await fetch('/xserv-ejecucion-viajes/iniciar-servicio', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
            },
            credentials: 'include',
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.success) {
            alert('Servicio iniciado correctamente');
            cerrarModal('modalIniciar');
            location.reload();
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        alert('Error al obtener ubicación: ' + error.message);
    }
}

async function finalizarServicio(event) {
    event.preventDefault();
    
    try {
        const ubicacion = await obtenerUbicacion();
        const formData = new FormData(event.target);
        
        const data = {
            ejecucion_id: formData.get('ejecucion_id'),
            km_fin: formData.get('km_fin'),
            lat_fin: ubicacion.lat,
            lng_fin: ubicacion.lng,
            observaciones_finales: formData.get('observaciones_finales')
        };

        const response = await fetch('/xserv-ejecucion-viajes/finalizar-servicio', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
            },
            credentials: 'include',
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.success) {
            alert('Servicio finalizado correctamente');
            cerrarModal('modalFinalizar');
            location.reload();
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        alert('Error al obtener ubicación: ' + error.message);
    }
}

async function reportarIncidencia(event) {
    event.preventDefault();
    
    try {
        const ubicacion = await obtenerUbicacion();
        const formData = new FormData(event.target);
        
        const data = {
            ejecucion_id: formData.get('ejecucion_id'),
            tipo_incidencia: formData.get('tipo_incidencia'),
            severidad: formData.get('severidad'),
            descripcion: formData.get('descripcion'),
            latitud_incidencia: ubicacion.lat,
            longitud_incidencia: ubicacion.lng
        };

        const response = await fetch('/xserv-incidencias-viaje/reportar-incidencia', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
            },
            credentials: 'include',
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.success) {
            alert('Incidencia reportada correctamente');
            cerrarModal('modalIncidencia');
            location.reload();
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        alert('Error al obtener ubicación: ' + error.message);
    }
}

async function resolverIncidencia(incidenciaId) {
    if (!confirm('¿Marcar esta incidencia como resuelta?')) {
        return;
    }

    try {
        const response = await fetch('/xserv-incidencias-viaje/resolver-incidencia', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
            },
            credentials: 'include',
            body: JSON.stringify({ incidencia_id: incidenciaId })
        });

        const result = await response.json();

        if (result.success) {
            alert('Incidencia resuelta correctamente');
            location.reload();
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        alert('Error: ' + error.message);
    }
}

// Cerrar modal al hacer clic fuera del contenido
document.querySelectorAll('.modal').forEach(modal => {
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.remove('active');
        }
    });
});
</script>

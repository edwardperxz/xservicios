<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservReserva $xservReserva
 * @var \Cake\Collection\CollectionInterface|string[] $clientes
 * @var \Cake\Collection\CollectionInterface|string[] $servicios
 * @var \Cake\Collection\CollectionInterface|string[] $rutas
 */
$estadoOptions = [
    'pendiente' => 'Pendiente',
    'confirmada' => 'Confirmada',
    'asignada' => 'Asignada',
    'completada' => 'Completada',
    'cancelada' => 'Cancelada',
];
$estadoPagoOptions = [
    'pendiente' => 'Pendiente',
    'parcial' => 'Parcial',
    'pagado' => 'Pagado',
    'reembolsado' => 'Reembolsado',
];
$this->assign('header-title', 'Nueva Reserva');
?>

<style>
    :root {
        --gold: #c9a962;
        --gold-light: #d4b978;
        --dark-bg: #0a0a0a;
        --dark-card: #1a1a1a;
        --dark-lighter: #2a2a2a;
        --text-white: #ffffff;
        --text-gray: #a0a0a0;
    }
    .form-container { width: 100%; padding: 1.5rem; display: flex; justify-content: center; }
    .form-card { background: var(--dark-card, #1a1a1a); border-radius: 12px; padding: 2rem; border: 1px solid var(--dark-lighter, #2a2a2a); width: 100%; max-width: 1000px; }
    .form-header { margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid var(--dark-lighter, #2a2a2a); }
    .form-title { font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--text-white, #ffffff); line-height: 1.3; }
    .form-subtitle { color: var(--text-gray, #a0a0a0); font-size: 0.875rem; line-height: 1.5; }
    .form-section { margin-bottom: 2rem; }
    .form-section-title { font-size: 1.1rem; color: var(--gold, #c9a962); margin-bottom: 1rem; font-weight: 600; }
    .form-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem; }
    .form-group { display: flex; flex-direction: column; min-width: 0; }
    .form-label { margin-bottom: 0.5rem; color: var(--text-white, #ffffff); font-size: 0.875rem; font-weight: 500; }
    .form-label.required::after { content: ' *'; color: #e74c3c; }
    .form-input, .form-select, .form-textarea { width: 100%; padding: 0.75rem 1rem; background: var(--dark-lighter, #2a2a2a); border: 1px solid var(--dark-lighter, #2a2a2a); border-radius: 8px; color: var(--text-white, #ffffff); font-size: 0.875rem; transition: all 0.2s; box-sizing: border-box; -webkit-appearance: none; -moz-appearance: none; appearance: none; }
    .form-textarea { resize: vertical; min-height: 100px; font-family: inherit; }
    .form-input:focus, .form-select:focus, .form-textarea:focus { outline: none; border-color: var(--gold, #c9a962); background: var(--dark-bg, #0a0a0a); }
    .form-select { cursor: pointer; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23ffffff' d='M6 9L1 4h10z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 1rem center; padding-right: 2.5rem; }
    .form-help { margin-top: 0.25rem; font-size: 0.75rem; color: var(--text-gray, #a0a0a0); line-height: 1.4; }
    .form-actions { display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--dark-lighter, #2a2a2a); flex-wrap: wrap; }
    .btn { padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.2s; border: none; cursor: pointer; font-size: 0.875rem; white-space: nowrap; min-width: 120px; }
    .btn-primary { background: var(--gold, #c9a962); color: var(--dark-bg, #0a0a0a); }
    .btn-primary:hover { background: var(--gold-light, #d4b978); transform: translateY(-1px); }
    .btn-secondary { background: var(--dark-lighter, #2a2a2a); color: var(--text-white, #ffffff); border: 1px solid var(--text-gray, #a0a0a0); }
    .btn-secondary:hover { background: var(--dark-card, #1a1a1a); border-color: var(--gold, #c9a962); }
    @media (max-width: 768px) {
        .form-container { padding: 1rem; }
        .form-card { padding: 1.5rem; border-radius: 8px; }
        .form-title { font-size: 1.25rem; }
        .form-section-title { font-size: 1rem; }
        .form-row { grid-template-columns: 1fr; gap: 1.25rem; }
        .form-actions { flex-direction: column; gap: 0.75rem; }
        .btn { width: 100%; min-width: auto; }
    }
    @media (max-width: 480px) {
        .form-container { padding: 0.75rem; }
        .form-card { padding: 1rem; border-radius: 6px; }
        .form-title { font-size: 1.125rem; }
        .form-subtitle { font-size: 0.8125rem; }
        .form-section-title { font-size: 0.9375rem; }
        .form-row { gap: 1rem; }
        .form-input, .form-select, .form-textarea { padding: 0.625rem 0.875rem; font-size: 0.8125rem; }
        .form-label { font-size: 0.8125rem; }
        .form-help { font-size: 0.6875rem; }
        .btn { padding: 0.625rem 1rem; font-size: 0.8125rem; }
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h2 class="form-title">Nueva Reserva</h2>
            <p class="form-subtitle">Complete el formulario para crear una nueva reserva de servicio</p>
        </div>

        <?= $this->Form->create($xservReserva) ?>
        

        <div class="form-section">
            <h3 class="form-section-title">Servicio y Ruta</h3>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label required">Servicio</label>
                    <?= $this->Form->control('servicio_id', ['options' => $servicios, 'empty' => 'Seleccione un servicio', 'class' => 'form-select', 'label' => false, 'required' => true]) ?>
                    <span class="form-help">Tipo de servicio solicitado</span>
                </div>
                <div class="form-group">
                    <label class="form-label">Ruta (Opcional)</label>
                    <?= $this->Form->control('ruta_id', ['options' => $rutas, 'empty' => 'Seleccione una ruta', 'class' => 'form-select', 'label' => false]) ?>
                    <span class="form-help">Ruta predefinida si aplica</span>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3 class="form-section-title">Fecha y Horario</h3>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label required">Fecha</label>
                    <?= $this->Form->control('fecha', ['type' => 'date', 'class' => 'form-input', 'label' => false, 'required' => true]) ?>
                    <span class="form-help">Fecha del servicio</span>
                </div>
                <div class="form-group">
                    <label class="form-label required">Hora</label>
                    <?= $this->Form->control('hora', ['type' => 'time', 'class' => 'form-input', 'label' => false, 'required' => true]) ?>
                    <span class="form-help">Hora de inicio</span>
                </div>
                <div class="form-group">
                    <label class="form-label required">Pasajeros</label>
                    <?= $this->Form->control('pasajeros', ['type' => 'number', 'min' => 1, 'class' => 'form-input', 'label' => false, 'placeholder' => 'ej: 10', 'required' => true]) ?>
                    <span class="form-help">Número de pasajeros</span>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3 class="form-section-title">Puntos de Recogida y Destino</h3>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Punto de Recogida</label>
                    <?= $this->Form->control('punto_recogida', ['class' => 'form-input', 'label' => false, 'placeholder' => 'Dirección o ubicación']) ?>
                    <span class="form-help">Lugar de partida</span>
                </div>
                <div class="form-group">
                    <label class="form-label">Punto de Destino</label>
                    <?= $this->Form->control('punto_destino', ['class' => 'form-input', 'label' => false, 'placeholder' => 'Dirección o ubicación']) ?>
                    <span class="form-help">Lugar de llegada</span>
                </div>
            </div>
        </div>


        <div class="form-section">
            <h3 class="form-section-title">Observaciones</h3>       
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Observaciones</label>
                    <?= $this->Form->control('observaciones', ['type' => 'textarea', 'class' => 'form-textarea', 'label' => false, 'placeholder' => 'Notas adicionales sobre la reserva']) ?>
                    <span class="form-help">Información adicional relevante</span>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Cancelar</a>
            <?= $this->Form->button('Guardar Reserva', ['class' => 'btn btn-primary']) ?>
        </div>
        
        <?= $this->Form->end() ?>
    </div>
</div>

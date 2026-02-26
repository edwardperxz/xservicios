<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservVehiculo $xservVehiculo
 */
$tipoOptions = [
    'coaster' => 'Coaster',
    'bus_15' => 'Bus 15',
];
$estadoOperativoOptions = [
    'disponible' => 'Disponible',
    'mantenimiento' => 'Mantenimiento',
    'asignado' => 'Asignado',
];
$this->assign('header-title', 'Editar Vehículo');
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
        --red: #ef4444;
        --red-dark: #dc2626;
    }
    .form-container { width: 100%; padding: 1.5rem; display: flex; justify-content: center; box-sizing: border-box; }
    .form-card { background: var(--dark-card, #1a1a1a); border-radius: 12px; padding: 2rem; border: 1px solid var(--dark-lighter, #2a2a2a); width: 100%; max-width: 1000px; box-sizing: border-box; }
    .form-header { margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid var(--dark-lighter, #2a2a2a); }
    .form-title { font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--text-white, #ffffff); line-height: 1.3; }
    .form-subtitle { color: var(--text-gray, #a0a0a0); font-size: 0.875rem; line-height: 1.5; }
    .form-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem; }
    .form-group { display: flex; flex-direction: column; min-width: 0; }
    .form-label { margin-bottom: 0.5rem; color: var(--text-white, #ffffff); font-size: 0.875rem; font-weight: 500; }
    .form-label.required::after { content: ' *'; color: #e74c3c; }
    .form-input, .form-select { width: 100%; padding: 0.75rem 1rem; background: var(--dark-lighter, #2a2a2a); border: 1px solid var(--dark-lighter, #2a2a2a); border-radius: 8px; color: var(--text-white, #ffffff); font-size: 0.875rem; transition: all 0.2s; box-sizing: border-box; -webkit-appearance: none; -moz-appearance: none; appearance: none; }
    .form-input:focus, .form-select:focus { outline: none; border-color: var(--gold, #c9a962); background: var(--dark-bg, #0a0a0a); }
    .form-select { cursor: pointer; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23ffffff' d='M6 9L1 4h10z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 1rem center; padding-right: 2.5rem; }
    .form-help { margin-top: 0.25rem; font-size: 0.75rem; color: var(--text-gray, #a0a0a0); line-height: 1.4; }
    .form-actions { display: flex; gap: 1rem; justify-content: space-between; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--dark-lighter, #2a2a2a); flex-wrap: wrap; }
    .form-actions-left, .form-actions-right { display: flex; gap: 1rem; flex-wrap: wrap; }
    .btn { padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.2s; border: none; cursor: pointer; font-size: 0.875rem; white-space: nowrap; min-width: 120px; }
    .btn-primary { background: var(--gold, #c9a962); color: var(--dark-bg, #0a0a0a); }
    .btn-primary:hover { background: var(--gold-light, #d4b978); transform: translateY(-1px); }
    .btn-secondary { background: var(--dark-lighter, #2a2a2a); color: var(--text-white, #ffffff); border: 1px solid var(--text-gray, #a0a0a0); }
    .btn-secondary:hover { background: var(--dark-card, #1a1a1a); border-color: var(--gold, #c9a962); }
    .btn-danger { background: var(--red, #ef4444); color: var(--text-white, #ffffff); }
    .btn-danger:hover { background: var(--red-dark, #dc2626); transform: translateY(-1px); }
    @media (max-width: 768px) {
        .form-container { padding: 1rem; }
        .form-card { padding: 1.5rem; border-radius: 8px; }
        .form-title { font-size: 1.25rem; }
        .form-row { grid-template-columns: 1fr; gap: 1.25rem; }
        .form-actions { flex-direction: column; }
        .form-actions-left, .form-actions-right { width: 100%; flex-direction: column; }
        .btn { width: 100%; min-width: auto; }
    }
    @media (max-width: 480px) {
        .form-container { padding: 0.75rem; }
        .form-card { padding: 1rem; border-radius: 6px; }
        .form-title { font-size: 1.125rem; }
        .form-subtitle { font-size: 0.8125rem; }
        .form-row { gap: 1rem; }
        .form-input, .form-select { padding: 0.625rem 0.875rem; font-size: 0.8125rem; }
        .form-label { font-size: 0.8125rem; }
        .form-help { font-size: 0.6875rem; }
        .btn { padding: 0.625rem 1rem; font-size: 0.8125rem; }
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h2 class="form-title">Editar Vehículo</h2>
            <p class="form-subtitle">Modifique la información del vehículo (campos marcados con * son obligatorios)</p>
        </div>

        <?= $this->Form->create($xservVehiculo) ?>
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label required">Tipo de Vehículo</label>
                <?= $this->Form->control('tipo', [
                    'options' => $tipoOptions,
                    'empty' => 'Seleccione un tipo',
                    'class' => 'form-select',
                    'label' => false,
                    'required' => true
                ]) ?>
                <span class="form-help">Categoría del vehículo</span>
            </div>
            <div class="form-group">
                <label class="form-label required">Nombre de Unidad</label>
                <?= $this->Form->control('nombre_unidad', [
                    'class' => 'form-input',
                    'label' => false,
                    'placeholder' => 'ej: Unidad 001',
                    'required' => true
                ]) ?>
                <span class="form-help">Identificador de la unidad</span>
            </div>
            <div class="form-group">
                <label class="form-label required">Placa</label>
                <?= $this->Form->control('placa', [
                    'class' => 'form-input',
                    'label' => false,
                    'placeholder' => 'ej: ABC-123',
                    'required' => true
                ]) ?>
                <span class="form-help">Número de placa del vehículo</span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label required">Capacidad Máxima</label>
                <?= $this->Form->control('capacidad_max', [
                    'type' => 'number',
                    'min' => 1,
                    'class' => 'form-input',
                    'label' => false,
                    'placeholder' => 'ej: 30',
                    'required' => true
                ]) ?>
                <span class="form-help">Número de pasajeros</span>
            </div>
            <div class="form-group">
                <label class="form-label required">Año</label>
                <?= $this->Form->control('anio', [
                    'type' => 'number',
                    'min' => 1900,
                    'max' => date('Y') + 1,
                    'class' => 'form-input',
                    'label' => false,
                    'placeholder' => 'ej: ' . date('Y'),
                    'required' => true
                ]) ?>
                <span class="form-help">Año de fabricación</span>
            </div>
            <div class="form-group">
                <label class="form-label">Kilometraje Actual</label>
                <?= $this->Form->control('kilometraje_actual', [
                    'type' => 'number',
                    'min' => 0,
                    'class' => 'form-input',
                    'label' => false,
                    'placeholder' => 'ej: 50000'
                ]) ?>
                <span class="form-help">Kilometraje en el odómetro</span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label required">Estado Operativo</label>
                <?= $this->Form->control('estado_operativo', [
                    'options' => $estadoOperativoOptions,
                    'empty' => 'Seleccione un estado',
                    'class' => 'form-select',
                    'label' => false,
                    'required' => true
                ]) ?>
                <span class="form-help">Condición actual del vehículo</span>
            </div>
        </div>

        <div class="form-actions">
            <div class="form-actions-left">
                <!-- Botón de eliminar movido fuera del formulario -->
            </div>
            <div class="form-actions-right">
                <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Cancelar</a>
                <?= $this->Form->button('Actualizar Vehículo', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        
        <?= $this->Form->end() ?>
        
        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--dark-lighter, #2a2a2a);">
            <?= $this->Form->postLink(
                'Eliminar Vehículo',
                ['action' => 'delete', $xservVehiculo->id],
                [
                    'confirm' => '¿Está seguro que desea eliminar este vehículo? Esta acción no se puede deshacer.',
                    'class' => 'btn btn-danger'
                ]
            ) ?>
        </div>
    </div>
</div>

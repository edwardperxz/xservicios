<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservChofer $xservChofere
 * @var string[]|\Cake\Collection\CollectionInterface $usuarios
 */
$estadoOptions = [
    'activo' => 'Activo',
    'inactivo' => 'Inactivo',
];
$disponibilidadOptions = [
    'disponible' => 'Disponible',
    'no_disponible' => 'No disponible',
    'asignado' => 'Asignado',
];
$this->assign('header-title', 'Editar Chofer');
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
            <h2 class="form-title">Editar Chofer</h2>
            <p class="form-subtitle">Modifique la información del chofer (campos marcados con * son obligatorios)</p>
        </div>

        <?= $this->Form->create($xservChofere) ?>
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Usuario (Opcional)</label>
                <?= $this->Form->control('usuario_id', [
                    'options' => $usuarios,
                    'empty' => 'Seleccione un usuario',
                    'class' => 'form-select',
                    'label' => false
                ]) ?>
                <span class="form-help">Vincular con usuario del sistema</span>
            </div>
            <div class="form-group">
                <label class="form-label required">Nombre Completo</label>
                <?= $this->Form->control('nombre', [
                    'class' => 'form-input',
                    'label' => false,
                    'placeholder' => 'ej: Juan Pérez',
                    'required' => true
                ]) ?>
                <span class="form-help">Nombre completo del chofer</span>
            </div>
            <div class="form-group">
                <label class="form-label required">Identificación</label>
                <?= $this->Form->control('identificacion', [
                    'class' => 'form-input',
                    'label' => false,
                    'placeholder' => 'ej: 8-123-456',
                    'required' => true
                ]) ?>
                <span class="form-help">Cédula o documento de identidad</span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Teléfono</label>
                <?= $this->Form->control('telefono', [
                    'class' => 'form-input',
                    'label' => false,
                    'placeholder' => '+507 6XXX-XXXX'
                ]) ?>
                <span class="form-help">Número de contacto</span>
            </div>
            <div class="form-group">
                <label class="form-label">Correo Electrónico</label>
                <?= $this->Form->control('correo', [
                    'type' => 'email',
                    'class' => 'form-input',
                    'label' => false,
                    'placeholder' => 'chofer@ejemplo.com'
                ]) ?>
                <span class="form-help">Correo electrónico del chofer</span>
            </div>
            <div class="form-group">
                <label class="form-label required">Tipo de Licencia</label>
                <?= $this->Form->control('tipo_licencia', [
                    'class' => 'form-input',
                    'label' => false,
                    'placeholder' => 'ej: E, D, C',
                    'required' => true
                ]) ?>
                <span class="form-help">Tipo de licencia de conducir</span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label required">Fecha de Ingreso</label>
                <?= $this->Form->control('fecha_ingreso', [
                    'type' => 'date',
                    'class' => 'form-input',
                    'label' => false,
                    'required' => true
                ]) ?>
                <span class="form-help">Fecha de ingreso a la empresa</span>
            </div>
            <div class="form-group">
                <label class="form-label required">Estado</label>
                <?= $this->Form->control('estado', [
                    'options' => $estadoOptions,
                    'empty' => 'Seleccione un estado',
                    'class' => 'form-select',
                    'label' => false,
                    'required' => true
                ]) ?>
                <span class="form-help">Estado del chofer</span>
            </div>
            <div class="form-group">
                <label class="form-label required">Disponibilidad</label>
                <?= $this->Form->control('disponibilidad', [
                    'options' => $disponibilidadOptions,
                    'empty' => 'Seleccione disponibilidad',
                    'class' => 'form-select',
                    'label' => false,
                    'required' => true
                ]) ?>
                <span class="form-help">Disponibilidad actual</span>
            </div>
        </div>

        <div class="form-actions">
            <div class="form-actions-left">
                <?= $this->Form->postLink(
                    'Eliminar',
                    ['action' => 'delete', $xservChofere->id],
                    [
                        'confirm' => '¿Está seguro que desea eliminar este chofer?',
                        'class' => 'btn btn-danger'
                    ]
                ) ?>
            </div>
            <div class="form-actions-right">
                <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Cancelar</a>
                <?= $this->Form->button('Actualizar Chofer', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        
        <?= $this->Form->end() ?>
    </div>
</div>

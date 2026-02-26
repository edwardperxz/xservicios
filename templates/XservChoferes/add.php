<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservChofer $xservChofere
 * @var \Cake\Collection\CollectionInterface|string[] $usuarios
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
$this->assign('header-title', 'Nuevo Chofer');
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
    .form-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem; }
    .form-group { display: flex; flex-direction: column; min-width: 0; }
    .form-label { margin-bottom: 0.5rem; color: var(--text-white, #ffffff); font-size: 0.875rem; font-weight: 500; }
    .form-label.required::after { content: ' *'; color: #e74c3c; }
    .form-input, .form-select { width: 100%; padding: 0.75rem 1rem; background: var(--dark-lighter, #2a2a2a); border: 1px solid var(--dark-lighter, #2a2a2a); border-radius: 8px; color: var(--text-white, #ffffff); font-size: 0.875rem; transition: all 0.2s; box-sizing: border-box; -webkit-appearance: none; -moz-appearance: none; appearance: none; }
    .form-input:focus, .form-select:focus { outline: none; border-color: var(--gold, #c9a962); background: var(--dark-bg, #0a0a0a); }
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
        .form-row { grid-template-columns: 1fr; gap: 1.25rem; }
        .form-actions { flex-direction: column; gap: 0.75rem; }
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
            <h2 class="form-title">Nuevo Chofer</h2>
            <p class="form-subtitle">Complete el formulario para agregar un nuevo chofer al sistema</p>
        </div>

        <?= $this->Form->create($xservChofere) ?>
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label required">Usuario</label>
                <?= $this->Form->control('usuario_id', [
                    'options' => $usuarios,
                    'empty' => 'Seleccione un usuario',
                    'class' => 'form-select',
                    'label' => false,
                    'required' => true
                ]) ?>
                <span class="form-help">Usuario del sistema vinculado a este chofer</span>
            </div>
            <div class="form-group">
                <label class="form-label required">Tipo de Licencia</label>
                <div style="display: flex; gap: 1rem; flex-wrap: wrap; padding: 0.75rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-white); cursor: pointer;">
                        <input type="checkbox" name="licencia_tipos[]" value="B" style="width: 18px; height: 18px; cursor: pointer;"> B
                    </label>
                    <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-white); cursor: pointer;">
                        <input type="checkbox" name="licencia_tipos[]" value="C" style="width: 18px; height: 18px; cursor: pointer;"> C
                    </label>
                    <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-white); cursor: pointer;">
                        <input type="checkbox" name="licencia_tipos[]" value="D" style="width: 18px; height: 18px; cursor: pointer;"> D
                    </label>
                    <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-white); cursor: pointer;">
                        <input type="checkbox" name="licencia_tipos[]" value="E1" style="width: 18px; height: 18px; cursor: pointer;"> E1
                    </label>
                    <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-white); cursor: pointer;">
                        <input type="checkbox" name="licencia_tipos[]" value="E2" style="width: 18px; height: 18px; cursor: pointer;"> E2
                    </label>
                    <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-white); cursor: pointer;">
                        <input type="checkbox" name="licencia_tipos[]" value="E3" style="width: 18px; height: 18px; cursor: pointer;"> E3
                    </label>
                    <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-white); cursor: pointer;">
                        <input type="checkbox" name="licencia_tipos[]" value="F" style="width: 18px; height: 18px; cursor: pointer;"> F
                    </label>
                    <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-white); cursor: pointer;">
                        <input type="checkbox" name="licencia_tipos[]" value="G" style="width: 18px; height: 18px; cursor: pointer;"> G
                    </label>
                    <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-white); cursor: pointer;">
                        <input type="checkbox" name="licencia_tipos[]" value="H" style="width: 18px; height: 18px; cursor: pointer;"> H
                    </label>
                    <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-white); cursor: pointer;">
                        <input type="checkbox" name="licencia_tipos[]" value="I" style="width: 18px; height: 18px; cursor: pointer;"> I
                    </label>
                    <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-white); cursor: pointer;">
                        <input type="checkbox" name="licencia_tipos[]" value="J" style="width: 18px; height: 18px; cursor: pointer;"> J
                    </label>
                </div>
                <?= $this->Form->hidden('tipo_licencia', ['id' => 'tipo_licencia_hidden']) ?>
                <span class="form-help">Seleccione uno o más tipos de licencia</span>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const checkboxes = document.querySelectorAll('input[name="licencia_tipos[]"]');
                    const hiddenInput = document.getElementById('tipo_licencia_hidden');
                    
                    checkboxes.forEach(checkbox => {
                        checkbox.addEventListener('change', function() {
                            const selected = Array.from(checkboxes)
                                .filter(cb => cb.checked)
                                .map(cb => cb.value);
                            hiddenInput.value = selected.join(', ');
                        });
                    });
                });
            </script>
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
        </div>

        <div class="form-row">
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
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Cancelar</a>
            <?= $this->Form->button('Guardar Chofer', ['class' => 'btn btn-primary']) ?>
        </div>
        
        <?= $this->Form->end() ?>
    </div>
</div>

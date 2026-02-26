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
    * { box-sizing: border-box; }
    
    :root {
        --gold: #c9a962;
        --gold-light: #d4b978;
        --dark-bg: #0a0a0a;
        --dark-card: #1a1a1a;
        --dark-lighter: #2a2a2a;
        --text-white: #ffffff;
        --text-gray: #a0a0a0;
    }
    
    .form-container { 
        width: 100%; 
        padding: 1.5rem; 
        display: flex; 
        justify-content: center; 
        background: var(--dark-bg);
    }
    
    .form-card { 
        background: var(--dark-card); 
        border-radius: 12px; 
        padding: 2rem; 
        border: 1px solid var(--dark-lighter); 
        width: 100%; 
        max-width: 900px; 
    }
    
    .form-header { 
        margin-bottom: 2rem; 
        padding-bottom: 1rem; 
        border-bottom: 1px solid var(--dark-lighter); 
    }
    
    .form-title { 
        font-size: 1.75rem; 
        font-weight: 700; 
        margin-bottom: 0.5rem; 
        color: var(--text-white); 
        line-height: 1.2; 
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .form-subtitle { 
        color: var(--text-gray); 
        font-size: 0.875rem; 
        line-height: 1.5; 
    }
    
    .form-row { 
        display: grid; 
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); 
        gap: 1.5rem; 
        margin-bottom: 1.5rem; 
    }
    
    .form-group { 
        display: flex; 
        flex-direction: column; 
        min-width: 0; 
    }
    
    .form-label { 
        margin-bottom: 0.5rem; 
        color: var(--text-white); 
        font-size: 0.875rem; 
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    
    .form-label.required::after { 
        content: ' *'; 
        color: #ef4444; 
    }
    
    .form-input, .form-select { 
        width: 100%; 
        padding: 0.85rem 1rem; 
        background: var(--dark-lighter); 
        border: 1px solid var(--dark-lighter); 
        border-radius: 8px; 
        color: var(--text-white); 
        font-size: 0.875rem; 
        transition: all 0.2s; 
        font-family: inherit;
    }
    
    .form-input:focus, .form-select:focus { 
        outline: none; 
        border-color: var(--gold); 
        background: rgba(201, 169, 98, 0.05);
        box-shadow: 0 0 0 3px rgba(201, 169, 98, 0.1);
    }
    
    .form-select { 
        cursor: pointer; 
        appearance: none;
        padding-right: 2.5rem;
        background-color: var(--dark-lighter);
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23ffffff' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
    }
    
    .form-help { 
        margin-top: 0.25rem; 
        font-size: 0.75rem; 
        color: var(--text-gray); 
        line-height: 1.4; 
    }
    
    .license-section {
        background: rgba(201, 169, 98, 0.05);
        border: 1px solid rgba(201, 169, 98, 0.1);
        border-radius: 8px;
        padding: 1rem;
    }
    
    .license-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
        gap: 0.75rem;
    }
    
    .license-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem;
        border-radius: 6px;
        background: var(--dark-lighter);
        color: var(--text-white);
        cursor: pointer;
        user-select: none;
        transition: all 0.2s;
        border: 1px solid transparent;
    }
    
    .license-label:hover {
        border-color: var(--gold);
        background: rgba(201, 169, 98, 0.1);
    }
    
    .license-label input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: var(--gold);
    }
    
    .form-actions { 
        display: flex; 
        gap: 1rem; 
        justify-content: flex-end; 
        margin-top: 2rem; 
        padding-top: 2rem; 
        border-top: 1px solid var(--dark-lighter);
        flex-wrap: wrap;
    }
    
    .btn { 
        padding: 0.85rem 2rem; 
        border-radius: 8px; 
        font-weight: 600; 
        text-decoration: none; 
        display: inline-flex; 
        align-items: center; 
        justify-content: center; 
        gap: 0.5rem; 
        transition: all 0.2s; 
        border: none; 
        cursor: pointer; 
        font-size: 0.875rem; 
        white-space: nowrap; 
        min-width: 140px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
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
    
    .btn-secondary { 
        background: var(--dark-lighter); 
        color: var(--text-white); 
        border: 1px solid var(--text-gray); 
    }
    
    .btn-secondary:hover { 
        background: var(--dark-card); 
        border-color: var(--gold); 
    }
    
    @media (max-width: 768px) {
        .form-container { padding: 1rem; }
        .form-card { padding: 1.5rem; border-radius: 8px; }
        .form-title { font-size: 1.5rem; }
        .form-row { grid-template-columns: 1fr; gap: 1.25rem; }
        .form-actions { flex-direction: column-reverse; }
        .btn { width: 100%; min-width: auto; }
        .license-grid { grid-template-columns: repeat(3, 1fr); }
    }

    @media (max-width: 480px) {
        .form-container { padding: 0.75rem; }
        .form-card { padding: 1rem; border-radius: 6px; }
        .form-title { font-size: 1.25rem; gap: 0.5rem; }
        .form-subtitle { font-size: 0.8rem; }
        .form-row { gap: 1rem; }
        .form-input, .form-select { padding: 0.75rem 0.875rem; font-size: 0.8125rem; }
        .form-label { font-size: 0.75rem; }
        .form-help { font-size: 0.65rem; }
        .btn { padding: 0.75rem 1rem; font-size: 0.75rem; min-width: 100px; }
        .license-grid { grid-template-columns: repeat(2, 1fr); }
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h2 class="form-title">
                <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Nuevo Chofer
            </h2>
            <p class="form-subtitle">Complete el formulario para registrar un nuevo chofer en el sistema</p>
        </div>

        <?= $this->Form->create($xservChofere) ?>
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label required">Usuario del Sistema</label>
                <?= $this->Form->control('usuario_id', [
                    'options' => $usuarios,
                    'empty' => '— Seleccione un usuario —',
                    'class' => 'form-select',
                    'label' => false,
                    'required' => true
                ]) ?>
                <span class="form-help">Seleccione el usuario vinculado a este chofer</span>
            </div>
            
            <div class="form-group">
                <label class="form-label required">Fecha de Ingreso</label>
                <?= $this->Form->control('fecha_ingreso', [
                    'type' => 'date',
                    'class' => 'form-input',
                    'label' => false,
                    'required' => true,
                    'value' => date('Y-m-d')
                ]) ?>
                <span class="form-help">Fecha en que se vinculó a la empresa</span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label required">Estado</label>
                <?= $this->Form->control('estado', [
                    'options' => $estadoOptions,
                    'empty' => '— Seleccione un estado —',
                    'class' => 'form-select',
                    'label' => false,
                    'required' => true
                ]) ?>
                <span class="form-help">Estado laboral del chofer</span>
            </div>
            
            <div class="form-group">
                <label class="form-label required">Disponibilidad</label>
                <?= $this->Form->control('disponibilidad', [
                    'options' => $disponibilidadOptions,
                    'empty' => '— Seleccione disponibilidad —',
                    'class' => 'form-select',
                    'label' => false,
                    'required' => true
                ]) ?>
                <span class="form-help">Disponibilidad inicial del chofer</span>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Tipos de Licencia</label>
            <div class="license-section">
                <div class="license-grid">
                    <label class="license-label">
                        <input type="checkbox" name="licencia_tipos[]" value="B">
                        Clase B
                    </label>
                    <label class="license-label">
                        <input type="checkbox" name="licencia_tipos[]" value="C">
                        Clase C
                    </label>
                    <label class="license-label">
                        <input type="checkbox" name="licencia_tipos[]" value="D">
                        Clase D
                    </label>
                    <label class="license-label">
                        <input type="checkbox" name="licencia_tipos[]" value="E1">
                        Clase E1
                    </label>
                    <label class="license-label">
                        <input type="checkbox" name="licencia_tipos[]" value="E2">
                        Clase E2
                    </label>
                    <label class="license-label">
                        <input type="checkbox" name="licencia_tipos[]" value="E3">
                        Clase E3
                    </label>
                    <label class="license-label">
                        <input type="checkbox" name="licencia_tipos[]" value="F">
                        Clase F
                    </label>
                    <label class="license-label">
                        <input type="checkbox" name="licencia_tipos[]" value="G">
                        Clase G
                    </label>
                    <label class="license-label">
                        <input type="checkbox" name="licencia_tipos[]" value="H">
                        Clase H
                    </label>
                    <label class="license-label">
                        <input type="checkbox" name="licencia_tipos[]" value="I">
                        Clase I
                    </label>
                    <label class="license-label">
                        <input type="checkbox" name="licencia_tipos[]" value="J">
                        Clase J
                    </label>
                </div>
            </div>
            <?= $this->Form->hidden('tipo_licencia', ['id' => 'tipo_licencia_hidden']) ?>
            <span class="form-help">Seleccione los tipos de licencia que posee el chofer</span>
        </div>

        <div class="form-actions">
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Cancelar</a>
            <?= $this->Form->button('Crear Chofer', ['class' => 'btn btn-primary', 'type' => 'submit']) ?>
        </div>
        
        <?= $this->Form->end() ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[name="licencia_tipos[]"]');
    const hiddenInput = document.getElementById('tipo_licencia_hidden');
    
    function updateHiddenInput() {
        const selected = Array.from(checkboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);
        hiddenInput.value = selected.join(', ');
    }
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateHiddenInput);
    });
});
</script>
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

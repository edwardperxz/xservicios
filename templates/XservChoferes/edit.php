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
    * { box-sizing: border-box; }
    
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
    
    .license-label{
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

    .btn-danger {
        background: var(--red);
        color: var(--text-white);
    }

    .btn-danger:hover {
        background: var(--red-dark);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .danger-section {
        background: rgba(239, 68, 68, 0.05);
        border: 1px solid rgba(239, 68, 68, 0.2);
        border-radius: 8px;
        padding: 2rem;
        margin-top: 2rem;
    }

    .danger-title {
        color: var(--red);
        margin-bottom: 1rem;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .danger-description {
        color: var(--text-gray);
        margin-bottom: 1.5rem;
        font-size: 0.875rem;
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
        .danger-section { padding: 1.5rem; }
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h2 class="form-title">
                <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Editar Chofer
            </h2>
            <p class="form-subtitle">Modifique la información del chofer (campos con * son obligatorios)</p>
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
                    'required' => true
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
                <span class="form-help">Disponibilidad actual del chofer</span>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Tipos de Licencia</label>
            <div class="license-section">
                <div class="license-grid">
                    <?php
                    $licenciaActual = isset($xservChofere->tipo_licencia) ? array_map('trim', explode(',', $xservChofere->tipo_licencia)) : [];
                    $categorias = ['B', 'C', 'D', 'E1', 'E2', 'E3', 'F', 'G', 'H', 'I', 'J'];
                    foreach ($categorias as $tipo) {
                        $checked = in_array($tipo, $licenciaActual) ? 'checked' : '';
                        echo '<label class="license-label">';
                        echo '<input type="checkbox" name="licencia_tipos[]" value="' . h($tipo) . '" ' . $checked . '>';
                        echo 'Clase ' . h($tipo);
                        echo '</label>';
                    }
                    ?>
                </div>
            </div>
            <?= $this->Form->hidden('tipo_licencia', ['id' => 'tipo_licencia_hidden', 'value' => $xservChofere->tipo_licencia]) ?>
            <span class="form-help">Seleccione los tipos de licencia que posee el chofer</span>
        </div>

        <div class="form-actions">
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Cancelar</a>
            <?= $this->Form->button('Guardar Cambios', ['class' => 'btn btn-primary', 'type' => 'submit']) ?>
        </div>
        
        <?= $this->Form->end() ?>

        <!-- Danger Zone -->
        <div class="danger-section">
            <h3 class="danger-title">⚠️ Zona de Peligro</h3>
            <p class="danger-description">
                Esta acción no se puede deshacer. Eliminar un chofer eliminará toda la información asociada.
            </p>
            <?= $this->Form->postLink(
                'Eliminar este Chofer',
                ['action' => 'delete', $xservChofere->id],
                [
                    'confirm' => '¿Está seguro que desea eliminar este chofer de forma permanente? Esta acción NO se puede deshacer.',
                    'class' => 'btn btn-danger'
                ]
            ) ?>
        </div>
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

        <div class="form-actions">
            <div class="form-actions-left">
                <!-- Botón de eliminar movido fuera del formulario -->
            </div>
            <div class="form-actions-right">
                <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Cancelar</a>
                <?= $this->Form->button('Actualizar Chofer', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        
        <?= $this->Form->end() ?>
        
        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--dark-lighter, #2a2a2a);">
            <?= $this->Form->postLink(
                'Eliminar Chofer',
                ['action' => 'delete', $xservChofere->id],
                [
                    'confirm' => '¿Está seguro que desea eliminar este chofer? Esta acción no se puede deshacer.',
                    'class' => 'btn btn-danger'
                ]
            ) ?>
        </div>
    </div>
</div>

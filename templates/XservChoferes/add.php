<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservChofer $xservChofere
 * @var \Cake\Collection\CollectionInterface|string[] $usuarios
 */
$estadoOptions = ['activo' => 'Activo', 'inactivo' => 'Inactivo'];
$disponibilidadOptions = ['disponible' => 'Disponible', 'no_disponible' => 'No disponible', 'asignado' => 'Asignado'];
$this->assign('header-title', 'Nuevo Chofer');
?>

<style>
    :root { --gold: #c9a962; --gold-light: #d4b978; --dark-bg: #0a0a0a; --dark-card: #1a1a1a; --dark-lighter: #2a2a2a; --text-white: #ffffff; --text-gray: #a0a0a0; }
    .form-container { width: 100%; padding: 1.5rem; display: flex; justify-content: center; }
    .form-card { background: var(--dark-card); border-radius: 12px; padding: 2rem; border: 1px solid var(--dark-lighter); width: 100%; max-width: 800px; }
    .form-header { margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid var(--dark-lighter); }
    .form-title { font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--text-white); }
    .form-subtitle { color: var(--text-gray); font-size: 0.875rem; }
    .form-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem; }
    .form-group { display: flex; flex-direction: column; }
    .form-label { margin-bottom: 0.5rem; color: var(--text-white); font-size: 0.875rem; font-weight: 500; }
    .form-label.required::after { content: ' *'; color: #ef4444; }
    .form-input, .form-select { width: 100%; padding: 0.75rem 1rem; background: var(--dark-lighter); border: 1px solid var(--dark-lighter); border-radius: 8px; color: var(--text-white); font-size: 0.875rem; transition: all 0.2s; }
    .form-input:focus, .form-select:focus { outline: none; border-color: var(--gold); background: var(--dark-bg); }
    .form-select { cursor: pointer; appearance: none; padding-right: 2.5rem; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23ffffff' d='M6 9L1 4h10z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 1rem center; }
    .form-help { margin-top: 0.25rem; font-size: 0.75rem; color: var(--text-gray); }
    .form-actions { display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--dark-lighter); }
    .btn { padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; border: none; cursor: pointer; font-size: 0.875rem; }
    .btn-primary { background: var(--gold); color: var(--dark-bg); }
    .btn-primary:hover { background: var(--gold-light); transform: translateY(-1px); }
    .btn-secondary { background: var(--dark-lighter); color: var(--text-white); border: 1px solid var(--text-gray); }
    .btn-secondary:hover { background: var(--dark-card); border-color: var(--gold); }
    @media (max-width: 768px) { .form-container { padding: 1rem; } .form-card { padding: 1.5rem; } .form-title { font-size: 1.25rem; } .form-row { grid-template-columns: 1fr; } .form-actions { flex-direction: column; } .btn { width: 100%; } }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h2 class="form-title">Nuevo Chofer</h2>
            <p class="form-subtitle">Complete el formulario para registrar un nuevo chofer</p>
        </div>

        <?= $this->Form->create($xservChofere, ['enctype' => 'multipart/form-data']) ?>
        
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
                <span class="form-help">Seleccione el usuario para este chofer</span>
            </div>
            <div class="form-group">
                <label class="form-label required">Fecha de Ingreso</label>
                <?= $this->Form->control('fecha_ingreso', [
                    'type' => 'date',
                    'class' => 'form-input',
                    'label' => false,
                    'required' => true
                ]) ?>
                <span class="form-help">Fecha de vinculación</span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label required">Estado</label>
                <?= $this->Form->control('estado', [
                    'options' => $estadoOptions,
                    'empty' => 'Seleccione estado',
                    'class' => 'form-select',
                    'label' => false,
                    'required' => true
                ]) ?>
                <span class="form-help">Estado laboral</span>
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
            <div class="form-group">
                <label class="form-label">Tipo de Licencia</label>
                <?= $this->Form->control('tipo_licencia', [
                    'class' => 'form-input',
                    'label' => false,
                    'placeholder' => 'ej: B, C, D'
                ]) ?>
                <span class="form-help">Categorías separadas por coma</span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Foto del Chofer</label>
                <input type="file" id="foto-input" name="foto" accept="image/*" class="form-input" style="cursor: pointer;">
                <span class="form-help">Seleccione una foto (JPG, PNG, WebP)</span>
                <?php if (!empty($xservChofere->foto_url)): ?>
                <div style="margin-top: 1rem; text-align: center;">
                    <img id="foto-preview" src="<?= h($xservChofere->foto_url) ?>" alt="Preview" style="width: 100%; height: 250px; object-fit: cover; border-radius: 6px;">
                </div>
                <?php else: ?>
                <div id="foto-preview-container" style="margin-top: 1rem; text-align: center; display: none;">
                    <img id="foto-preview" alt="Preview" style="width: 100%; height: 250px; object-fit: cover; border-radius: 6px;">
                </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-actions">
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Cancelar</a>
            <?= $this->Form->button('Guardar Chofer', ['class' => 'btn btn-primary']) ?>
        </div>
        
        <?= $this->Form->end() ?>
    </div>
</div>

<script>
document.getElementById('foto-input').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            let preview = document.getElementById('foto-preview');
            if (!preview) {
                const container = document.createElement('div');
                container.id = 'foto-preview-container';
                container.style.marginTop = '1rem';
                container.style.textAlign = 'center';
                preview = document.createElement('img');
                preview.id = 'foto-preview';
                preview.style.width = '100%';
                preview.style.height = '250px';
                preview.style.objectFit = 'cover';
                preview.style.borderRadius = '6px';
                container.appendChild(preview);
                document.getElementById('foto-input').parentElement.appendChild(container);
            }
            preview.src = event.target.result;
            document.getElementById('foto-preview-container')?.style.display === 'none' && (document.getElementById('foto-preview-container').style.display = 'block');
        };
        reader.readAsDataURL(file);
    }
});
</script>

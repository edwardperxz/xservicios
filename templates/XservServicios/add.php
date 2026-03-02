<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservServicio $xservServicio
 */
$estadoOptions = [
    'activo' => 'Activo',
    'inactivo' => 'Inactivo',
];
$this->assign('header-title', 'Nuevo Servicio');
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
    .info-box { background: rgba(59, 130, 246, 0.1); border-left: 4px solid #3b82f6; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem; }
    .info-box p { color: #60a5fa; font-size: 0.875rem; margin: 0; line-height: 1.5; }
    .char-counter { font-size: 0.75rem; color: var(--text-gray); margin-top: 0.25rem; }
    .price-preview { background: rgba(74, 222, 128, 0.1); border: 1px solid rgba(74, 222, 128, 0.3); padding: 0.75rem 1rem; border-radius: 6px; margin-top: 0.5rem; }
    .price-preview-label { font-size: 0.75rem; color: var(--text-gray); margin-bottom: 0.25rem; }
    .price-preview-value { font-size: 1.125rem; color: #4ade80; font-weight: 600; }
    .icon-input { position: relative; }
    .icon-input svg { position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); width: 18px; height: 18px; color: var(--text-gray); pointer-events: none; }
    .icon-input input, .icon-input textarea { padding-left: 2.5rem; }
    .badge-preview { display: inline-block; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.75rem; font-weight: 600; margin-top: 0.5rem; }
    .badge-preview.activo { background: rgba(74, 222, 128, 0.2); color: #4ade80; }
    .badge-preview.inactivo { background: rgba(239, 68, 68, 0.2); color: #ef4444; }
    @media (max-width: 1024px) {
        .form-container { padding: 1.25rem; }
        .form-card { padding: 1.75rem; }
        .form-title { font-size: 1.35rem; }
    }

    @media (max-width: 768px) {
        .form-container { padding: 1rem; }
        .form-card { padding: 1.5rem; border-radius: 8px; }
        .form-title { font-size: 1.25rem; }
        .form-row { grid-template-columns: 1fr; gap: 1.25rem; }
        .form-actions { flex-direction: column; gap: 0.75rem; }
        .btn { width: 100%; min-width: auto; }
        .icon-input svg { width: 16px; height: 16px; left: 0.625rem; }
        .icon-input input, .icon-input textarea { padding-left: 2.25rem; }
    }

    @media (max-width: 640px) {
        .form-container { padding: 0.75rem; }
        .form-card { padding: 1.25rem; }
        .form-title { font-size: 1.1rem; }
        .form-subtitle { font-size: 0.8rem; }
        .form-row { gap: 1rem; }
        .form-label { font-size: 0.8125rem; }
        .form-input, .form-select, .form-textarea { padding: 0.625rem 0.875rem; font-size: 0.8rem; }
        .form-help { font-size: 0.7rem; }
        .form-header { margin-bottom: 1.5rem; padding-bottom: 0.875rem; }
        .char-counter { font-size: 0.7rem; }
        .info-box { padding: 0.875rem; }
        .info-box p { font-size: 0.8rem; }
        .badge-preview { font-size: 0.7rem; padding: 0.2rem 0.6rem; }
    }

    @media (max-width: 480px) {
        .form-container { padding: 0.5rem; }
        .form-card { padding: 0.875rem; border-radius: 6px; }
        .form-title { font-size: 1rem; line-height: 1.2; }
        .form-subtitle { font-size: 0.75rem; }
        .form-row { gap: 0.75rem; margin-bottom: 1rem; }
        .form-group { min-width: 0; }
        .form-label { font-size: 0.75rem; margin-bottom: 0.375rem; }
        .form-input, .form-select, .form-textarea { padding: 0.5rem 0.75rem; font-size: 0.75rem; border-radius: 6px; }
        .form-textarea { min-height: 80px; }
        .form-help { font-size: 0.65rem; margin-top: 0.2rem; }
        .form-actions { gap: 0.5rem; margin-top: 1.5rem; padding-top: 1.5rem; }
        .btn { padding: 0.5rem 0.75rem; font-size: 0.7rem; }
        .icon-input svg { width: 14px; height: 14px; }
        .price-preview { padding: 0.5rem 0.75rem; margin-top: 0.375rem; }
        .price-preview-label { font-size: 0.65rem; margin-bottom: 0.2rem; }
        .price-preview-value { font-size: 1rem; }
        .char-counter { font-size: 0.65rem; }
        .info-box { padding: 0.75rem; margin-bottom: 1rem; }
        .info-box p { font-size: 0.75rem; }
    }

    @media (max-width: 360px) {
        .form-container { padding: 0.5rem; }
        .form-card { padding: 0.75rem; }
        .form-title { font-size: 0.95rem; }
        .form-subtitle { font-size: 0.7rem; }
        .form-input, .form-select, .form-textarea { padding: 0.5rem; font-size: 0.7rem; }
        .btn { padding: 0.45rem 0.6rem; font-size: 0.65rem; }
        .form-row { gap: 0.5rem; }
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h2 class="form-title">Nuevo Servicio</h2>
            <p class="form-subtitle">Complete el formulario para agregar un nuevo servicio turístico (campos marcados con * son obligatorios)</p>
        </div>

        <?= $this->Form->create($xservServicio) ?>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label required">Nombre del Servicio</label>
                <div class="icon-input">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    <?= $this->Form->control('nombre', ['class' => 'form-input', 'id' => 'nombre-input', 'label' => false, 'placeholder' => 'ej: Tour Cafetalero en Boquete', 'required' => true, 'maxlength' => 100]) ?>
                </div>
                <span class="form-help">Nombre descriptivo que veran los clientes</span>
                <div id="nombre-counter" class="char-counter">0 / 100 caracteres</div>
            </div>
            <div class="form-group">
                <label class="form-label required">Precio Base (USD)</label>
                <div class="icon-input">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <?= $this->Form->control('precio_base', ['type' => 'number', 'step' => '0.01', 'min' => 0, 'id' => 'precio-input', 'class' => 'form-input', 'label' => false, 'placeholder' => '0.00', 'required' => true]) ?>
                </div>
                <span class="form-help">Precio sin impuestos</span>
                <div id="precio-preview" class="price-preview" style="display: none;">
                    <div class="price-preview-label">Precio final (con ITBMS 7%)</div>
                    <div class="price-preview-value">$<span id="precio-total">0.00</span></div>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Descripcion del Servicio (Español)</label>
                <div class="icon-input">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                    </svg>
                    <?= $this->Form->control('descripcion', ['type' => 'textarea', 'id' => 'descripcion-input', 'class' => 'form-textarea', 'label' => false, 'placeholder' => 'Descripcion detallada del servicio en espanol', 'rows' => 5]) ?>
                </div>
                <span class="form-help">Descripcion base en espanol. Las traducciones se gestionan en la tabla i18n.</span>
                <div id="descripcion-counter" class="char-counter">0 caracteres</div>
            </div>
        </div>

        <?= $this->Form->control('descripcion_key', ['type' => 'hidden', 'id' => 'descripcion-key-input']) ?>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label required">Estado del Servicio</label>
                <div class="icon-input">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <?= $this->Form->control('estado', ['options' => $estadoOptions, 'id' => 'estado-select', 'empty' => 'Seleccione un estado', 'class' => 'form-select', 'label' => false, 'required' => true]) ?>
                </div>
                <span class="form-help">Los clientes solo veran servicios activos</span>
                <div id="estado-preview"></div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Variantes del Servicio</label>
                <?= $this->Form->control('variantes', ['type' => 'textarea', 'id' => 'variantes-input', 'class' => 'form-textarea', 'label' => false, 'placeholder' => 'privado, compartido, VIP, economico', 'rows' => 4]) ?>
                <span class="form-help">Ejemplo: <em>privado, compartido, VIP</em> (separar con comas)</span>
                <div id="variantes-counter" class="char-counter">0 caracteres</div>
            </div>
        </div>

        <div class="form-actions">
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Cancelar</a>
            <?= $this->Form->button('Guardar Servicio', ['class' => 'btn btn-primary']) ?>
        </div>
        
        <?= $this->Form->end() ?>
    </div>
</div>

<script>
// Form helpers
document.addEventListener('DOMContentLoaded', function() {
    // Character counter for nombre
    const nombreInput = document.getElementById('nombre-input');
    const nombreCounter = document.getElementById('nombre-counter');
    if (nombreInput && nombreCounter) {
        function updateNombreCounter() {
            const length = nombreInput.value.length;
            nombreCounter.textContent = length + ' / 100 caracteres';
            nombreCounter.style.color = length > 90 ? '#ef4444' : 'var(--text-gray)';
        }
        nombreInput.addEventListener('input', updateNombreCounter);
        updateNombreCounter();
    }

    // Price calculator with ITBMS
    const precioInput = document.getElementById('precio-input');
    const precioPreview = document.getElementById('precio-preview');
    const precioTotal = document.getElementById('precio-total');
    if (precioInput && precioPreview && precioTotal) {
        function updatePrecio() {
            const precio = parseFloat(precioInput.value) || 0;
            if (precio > 0) {
                const itbms = precio * 0.07;
                const total = precio + itbms;
                precioTotal.textContent = total.toFixed(2);
                precioPreview.style.display = 'block';
            } else {
                precioPreview.style.display = 'none';
            }
        }
        precioInput.addEventListener('input', updatePrecio);
        updatePrecio();
    }

    // Estado preview badge
    const estadoSelect = document.getElementById('estado-select');
    const estadoPreview = document.getElementById('estado-preview');
    if (estadoSelect && estadoPreview) {
        function updateEstadoPreview() {
            const estado = estadoSelect.value;
            if (estado) {
                estadoPreview.innerHTML = '<span class="badge-preview ' + estado + '">Vista previa: ' + estadoSelect.options[estadoSelect.selectedIndex].text + '</span>';
            } else {
                estadoPreview.innerHTML = '';
            }
        }
        estadoSelect.addEventListener('change', updateEstadoPreview);
        updateEstadoPreview();
    }

    // Auto-generate descripcion_key from nombre
    const nombreInput = document.getElementById('nombre-input');
    const descripcionKeyInput = document.getElementById('descripcion-key-input');
    if (nombreInput && descripcionKeyInput) {
        function generateDescripcionKey() {
            const nombre = nombreInput.value.trim();
            if (nombre) {
                // Convert to lowercase, replace spaces and special chars with underscores
                const slug = nombre.toLowerCase()
                    .normalize('NFD').replace(/[\u0300-\u036f]/g, '') // Remove accents
                    .replace(/[^a-z0-9]+/g, '_') // Replace non-alphanumeric with underscore
                    .replace(/^_+|_+$/g, ''); // Remove leading/trailing underscores
                descripcionKeyInput.value = 'services.' + slug + '.description';
            } else {
                descripcionKeyInput.value = '';
            }
        }
        nombreInput.addEventListener('input', generateDescripcionKey);
        nombreInput.addEventListener('blur', generateDescripcionKey);
        generateDescripcionKey(); // Initialize on page load
    }

    // Character counter for variantes
    const variantesInput = document.getElementById('variantes-input');
    const variantesCounter = document.getElementById('variantes-counter');
    if (variantesInput && variantesCounter) {
        function updateVariantesCounter() {
            const length = variantesInput.value.length;
            variantesCounter.textContent = length + ' caracteres';
        }
        variantesInput.addEventListener('input', updateVariantesCounter);
        updateVariantesCounter();

        // Character counter for descripcion
        const descripcionInput = document.getElementById('descripcion-input');
        const descripcionCounter = document.getElementById('descripcion-counter');
        if (descripcionInput && descripcionCounter) {
            function updateDescripcionCounter() {
                const length = descripcionInput.value.length;
                descripcionCounter.textContent = length + ' caracteres';
            }
            descripcionInput.addEventListener('input', updateDescripcionCounter);
            updateDescripcionCounter();
        }
    }

    // Form validation feedback
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let allValid = true;
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    allValid = false;
                    field.style.borderColor = '#ef4444';
                } else {
                    field.style.borderColor = '';
                }
            });
            if (!allValid) {
                e.preventDefault();
                alert('Por favor complete todos los campos obligatorios (marcados con *)');
            }
        });
    }
});
</script>

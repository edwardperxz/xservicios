<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservDestino $xservDestino
 * @var \Cake\Collection\CollectionInterface|string[] $ubicacions
 */
$esPopularOptions = [
    '1' => 'Si',
    '0' => 'No',
];
$this->assign('header-title', 'Nuevo Destino');
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
        .form-input, .form-select, .form-textarea { padding: 0.625rem 0.875rem; font-size: 0.8125rem; }
        .form-label { font-size: 0.8125rem; }
        .form-help { font-size: 0.6875rem; }
        .btn { padding: 0.625rem 1rem; font-size: 0.8125rem; }
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h2 class="form-title">Nuevo Destino</h2>
            <p class="form-subtitle">Complete el formulario para agregar un nuevo destino turístico</p>
        </div>

        <?= $this->Form->create($xservDestino) ?>
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label required">Ubicación</label>
                <?= $this->Form->control('ubicacion_id', ['options' => $ubicacions, 'empty' => 'Seleccione una ubicación', 'class' => 'form-select', 'label' => false, 'required' => true]) ?>
                <span class="form-help">Ubicación geográfica</span>
            </div>
            <div class="form-group">
                <label class="form-label">Destino Popular</label>
                <?= $this->Form->control('es_popular', ['options' => $esPopularOptions, 'empty' => 'Seleccione', 'class' => 'form-select', 'label' => false]) ?>
                <span class="form-help">Es destino destacado</span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label required">Descripción</label>
                <?= $this->Form->control('descripcion_es', ['type' => 'textarea', 'id' => 'descripcion-es', 'class' => 'form-textarea', 'label' => false, 'placeholder' => 'Descripción del destino', 'required' => true, 'rows' => 5]) ?>
                <span class="form-help">Ingrese la descripción en español. El sistema traducirá automáticamente al inglés.</span>
            </div>
        </div>

        <?= $this->Form->control('descripcion_en', ['type' => 'hidden', 'id' => 'descripcion-en']) ?>

        <div class="form-actions">
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Cancelar</a>
            <?= $this->Form->button('Guardar Destino', ['class' => 'btn btn-primary']) ?>
        </div>
        
        <?= $this->Form->end() ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const descripcionEs = document.getElementById('descripcion-es');
    const descripcionEn = document.getElementById('descripcion-en');
    let translationTimeout = null;

    // Función para traducir usando API gratuita de MyMemory
    async function translateText(text) {
        if (!text || text.trim().length === 0) {
            return '';
        }
        
        try {
            // Usar MyMemory Translation API (gratuita, sin API key necesaria)
            const response = await fetch(`https://api.mymemory.translated.net/get?q=${encodeURIComponent(text)}&langpair=es|en`);
            const data = await response.json();
            
            if (data.responseData && data.responseData.translatedText) {
                return data.responseData.translatedText;
            }
            
            // Si falla la traducción, devolver el texto original
            return text;
        } catch (error) {
            console.error('Error en traducción:', error);
            // En caso de error, usar el texto original
            return text;
        }
    }

    // Traducir automáticamente mientras el usuario escribe (con debounce)
    if (descripcionEs && descripcionEn) {
        descripcionEs.addEventListener('input', function() {
            // Limpiar timeout anterior
            if (translationTimeout) {
                clearTimeout(translationTimeout);
            }
            
            // Esperar 1 segundo después de que el usuario deje de escribir
            translationTimeout = setTimeout(async () => {
                const textEs = descripcionEs.value.trim();
                if (textEs) {
                    // Mostrar indicador de traducción
                    const helpText = descripcionEs.parentElement.querySelector('.form-help');
                    const originalText = helpText.textContent;
                    helpText.textContent = 'Traduciendo automáticamente...';
                    helpText.style.color = 'var(--gold)';
                    
                    // Realizar traducción
                    const translated = await translateText(textEs);
                    descripcionEn.value = translated;
                    
                    // Restaurar texto de ayuda
                    helpText.textContent = originalText;
                    helpText.style.color = '';
                } else {
                    descripcionEn.value = '';
                }
            }, 1000); // Esperar 1 segundo después de que el usuario deje de escribir
        });
    }
});
</script>

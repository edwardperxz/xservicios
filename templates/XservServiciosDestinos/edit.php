<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservServicioDestino $xservServiciosDestino
 * @var \Cake\Collection\CollectionInterface|string[] $servicios
 * @var \Cake\Collection\CollectionInterface|string[] $destinos
 */
$this->assign('header-title', 'Editar Servicio-Destino');
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
    .btn-danger { background: #e74c3c; color: var(--text-white, #ffffff); }
    .btn-danger:hover { background: #c0392b; transform: translateY(-1px); }
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
            <h2 class="form-title">Editar Servicio-Destino</h2>
            <p class="form-subtitle">Modifique la asociación entre servicio y destino turístico</p>
        </div>

        <?= $this->Form->create($xservServiciosDestino) ?>
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label required">Servicio</label>
                <?= $this->Form->control('servicio_id', ['options' => $servicios, 'empty' => 'Seleccione un servicio', 'class' => 'form-select', 'label' => false, 'required' => true]) ?>
                <span class="form-help">Servicio turístico</span>
            </div>
            <div class="form-group">
                <label class="form-label required">Destino</label>
                <?= $this->Form->control('destino_id', ['options' => $destinos, 'empty' => 'Seleccione un destino', 'class' => 'form-select', 'label' => false, 'required' => true]) ?>
                <span class="form-help">Destino incluido en el servicio</span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Orden de Visita</label>
                <?= $this->Form->control('orden_visita', ['type' => 'number', 'min' => 1, 'class' => 'form-input', 'label' => false, 'placeholder' => 'ej: 1, 2, 3...']) ?>
                <span class="form-help">Secuencia en el itinerario</span>
            </div>
        </div>

        <div class="form-actions">
            <div class="form-actions-left">
                <!-- Botón de eliminar movido fuera del formulario -->
            </div>
            <div class="form-actions-right">
                <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Cancelar</a>
                <?= $this->Form->button('Actualizar Asociación', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        
        <?= $this->Form->end() ?>
        
        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--dark-lighter, #2a2a2a);">
            <?= $this->Form->postLink(
                'Eliminar Asociación',
                ['action' => 'delete', $xservServiciosDestino->servicio_id],
                ['confirm' => '¿Está seguro de eliminar esta asociación? Esta acción no se puede deshacer.', 'class' => 'btn btn-danger']
            ) ?>
        </div>
    </div>
</div>

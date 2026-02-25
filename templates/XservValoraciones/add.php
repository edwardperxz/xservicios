<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservValoracion $xservValoracione
 * @var \Cake\Collection\CollectionInterface|string[] $xservReservas
 */
$calificacionOptions = [
    '1' => '⭐ 1 estrella',
    '2' => '⭐⭐ 2 estrellas',
    '3' => '⭐⭐⭐ 3 estrellas',
    '4' => '⭐⭐⭐⭐ 4 estrellas',
    '5' => '⭐⭐⭐⭐⭐ 5 estrellas',
];
$mostrarOptions = [
    '1' => 'Sí',
    '0' => 'No',
];
$estadoModeracionOptions = [
    'pendiente' => 'Pendiente',
    'aprobado' => 'Aprobado',
    'rechazado' => 'Rechazado',
];
$this->assign('header-title', 'Nueva Valoración');
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
            <h2 class="form-title">Nueva Valoración</h2>
            <p class="form-subtitle">Registre la valoración de un cliente sobre el servicio recibido</p>
        </div>

        <?= $this->Form->create($xservValoracione) ?>
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label required">Reserva</label>
                <?= $this->Form->control('reserva_id', ['options' => $xservReservas, 'empty' => 'Seleccione una reserva', 'class' => 'form-select', 'label' => false, 'required' => true]) ?>
                <span class="form-help">Reserva a valorar</span>
            </div>
            <div class="form-group">
                <label class="form-label required">Calificación General</label>
                <?= $this->Form->control('calificacion', ['options' => $calificacionOptions, 'empty' => 'Seleccione calificación', 'class' => 'form-select', 'label' => false, 'required' => true]) ?>
                <span class="form-help">Valoración general del servicio</span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Puntuación - Limpieza</label>
                <?= $this->Form->control('puntuacion_limpieza', ['options' => $calificacionOptions, 'empty' => 'Seleccione', 'class' => 'form-select', 'label' => false]) ?>
                <span class="form-help">Calificación de limpieza del vehículo</span>
            </div>
            <div class="form-group">
                <label class="form-label">Puntuación - Puntualidad</label>
                <?= $this->Form->control('puntuacion_puntualidad', ['options' => $calificacionOptions, 'empty' => 'Seleccione', 'class' => 'form-select', 'label' => false]) ?>
                <span class="form-help">Calificación de puntualidad del servicio</span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Comentarios</label>
                <?= $this->Form->control('comentarios', ['type' => 'textarea', 'class' => 'form-textarea', 'label' => false, 'placeholder' => 'Comentarios del cliente sobre el servicio...']) ?>
                <span class="form-help">Comentarios adicionales del cliente</span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Mostrar en Web</label>
                <?= $this->Form->control('mostrar_en_web', ['options' => $mostrarOptions, 'empty' => 'Seleccione', 'class' => 'form-select', 'label' => false]) ?>
                <span class="form-help">¿Publicar en el sitio web?</span>
            </div>
            <div class="form-group">
                <label class="form-label">Estado de Moderación</label>
                <?= $this->Form->control('estado_moderacion', ['options' => $estadoModeracionOptions, 'empty' => 'Seleccione un estado', 'class' => 'form-select', 'label' => false]) ?>
                <span class="form-help">Estado de revisión del comentario</span>
            </div>
        </div>

        <div class="form-actions">
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Cancelar</a>
            <?= $this->Form->button('Guardar Valoración', ['class' => 'btn btn-primary']) ?>
        </div>
        
        <?= $this->Form->end() ?>
    </div>
</div>

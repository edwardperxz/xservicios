<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservUsuario $user
 */
$this->assign('header-title', 'Programar envio de reportes');
?>

<style>
    .schedule-card {
        background: var(--dark-card);
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid var(--dark-lighter);
        max-width: 600px;
    }

    .schedule-title {
        font-size: 1.25rem;
        color: var(--text-white);
        margin-bottom: 0.5rem;
    }

    .schedule-desc {
        color: var(--text-gray);
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.4rem;
        color: var(--text-gray);
        font-size: 0.85rem;
    }

    .form-input,
    .form-select {
        width: 100%;
        padding: 0.75rem 1rem;
        background: var(--dark-lighter);
        border: 1px solid var(--dark-lighter);
        border-radius: 8px;
        color: var(--text-white);
        font-size: 0.9rem;
    }

    .form-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .btn-primary {
        padding: 0.6rem 1rem;
        background: var(--gold);
        color: var(--dark-bg);
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
    }

    .btn-secondary {
        padding: 0.6rem 1rem;
        background: var(--dark-lighter);
        color: var(--text-white);
        border: 1px solid var(--dark-lighter);
        border-radius: 6px;
        text-decoration: none;
    }
</style>

<div class="schedule-card">
    <h2 class="schedule-title">Programar envio de reportes</h2>
    <p class="schedule-desc">Configura el envio automatico a un correo y frecuencia.</p>

    <?= $this->Form->create(null) ?>
        <div class="form-group">
            <label class="form-label" for="email">Correo destino</label>
            <input class="form-input" type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="frecuencia">Frecuencia</label>
            <select class="form-select" id="frecuencia" name="frecuencia" required>
                <option value="diario">Diario</option>
                <option value="semanal">Semanal</option>
                <option value="mensual">Mensual</option>
            </select>
        </div>

        <div class="form-actions">
            <button class="btn-primary" type="submit">Guardar programacion</button>
            <a class="btn-secondary" href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'reportes']) ?>">Volver</a>
        </div>
    <?= $this->Form->end() ?>
</div>

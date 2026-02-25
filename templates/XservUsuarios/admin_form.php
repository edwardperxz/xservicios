<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservUsuario $xservUsuario
 * @var bool $isAdmin
 */
$isEdit = !$xservUsuario->isNew();
$this->assign('header-title', $isEdit ? 'Editar Usuario' : 'Nuevo Usuario');
?>

<style>
    .form-card {
        background: var(--dark-card);
        border-radius: 12px;
        padding: 2rem;
        border: 1px solid var(--dark-lighter);
        max-width: 800px;
    }

    .form-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--dark-lighter);
    }

    .form-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .form-subtitle {
        color: var(--text-gray);
        font-size: 0.875rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-label {
        margin-bottom: 0.5rem;
        color: var(--text-white);
        font-size: 0.875rem;
        font-weight: 500;
    }

    .form-label.required::after {
        content: ' *';
        color: var(--red);
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        background: var(--dark-lighter);
        border: 1px solid var(--dark-lighter);
        border-radius: 8px;
        color: var(--text-white);
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--gold);
    }

    .form-select {
        cursor: pointer;
    }

    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }

    .form-help {
        margin-top: 0.25rem;
        font-size: 0.75rem;
        color: var(--text-gray);
    }

    .form-error {
        margin-top: 0.25rem;
        font-size: 0.75rem;
        color: var(--red);
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid var(--dark-lighter);
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
        font-size: 0.875rem;
    }

    .btn-primary {
        background: var(--gold);
        color: var(--dark-bg);
    }

    .btn-primary:hover {
        background: var(--gold-light);
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

    .icon-sm {
        width: 16px;
        height: 16px;
    }

    input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h2 class="form-title"><?= $isEdit ? 'Editar Usuario' : 'Nuevo Usuario' ?></h2>
            <p class="form-subtitle">
                <?= $isEdit ? 'Actualice la información del usuario' : 'Complete el formulario para crear un nuevo usuario' ?>
            </p>
        </div>

        <?= $this->Form->create($xservUsuario) ?>
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label required">Nombre de Usuario</label>
                <?= $this->Form->control('username', [
                    'class' => 'form-input',
                    'label' => false,
                    'placeholder' => 'ej: jdoe',
                    'required' => true
                ]) ?>
                <span class="form-help">Identificador único para iniciar sesión</span>
            </div>

            <div class="form-group">
                <label class="form-label">Correo Electrónico</label>
                <?= $this->Form->control('correo', [
                    'type' => 'email',
                    'class' => 'form-input',
                    'label' => false,
                    'placeholder' => 'usuario@ejemplo.com'
                ]) ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label <?= $isEdit ? '' : 'required' ?>">Contraseña</label>
                <?= $this->Form->control('password', [
                    'type' => 'password',
                    'class' => 'form-input',
                    'label' => false,
                    'placeholder' => '••••••••',
                    'required' => !$isEdit,
                    'value' => ''
                ]) ?>
                <?php if ($isEdit): ?>
                    <span class="form-help">Dejar en blanco para mantener la contraseña actual</span>
                <?php else: ?>
                    <span class="form-help">Mínimo 8 caracteres</span>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($isAdmin ?? false): ?>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label required">Rol</label>
                <?= $this->Form->control('rol', [
                    'type' => 'select',
                    'options' => [
                        'admin' => 'Administrador',
                        'operador' => 'Operador',
                        'chofer' => 'Chofer'
                    ],
                    'class' => 'form-select',
                    'label' => false,
                    'required' => true
                ]) ?>
                <span class="form-help">Nivel de acceso del usuario</span>
            </div>

            <div class="form-group">
                <label class="form-label required">Estado</label>
                <?= $this->Form->control('estado', [
                    'type' => 'select',
                    'options' => [
                        'activo' => 'Activo',
                        'inactivo' => 'Inactivo'
                    ],
                    'class' => 'form-select',
                    'label' => false,
                    'required' => true
                ]) ?>
                <span class="form-help">Estado actual del usuario</span>
            </div>
        </div>
        <?php endif; ?>

        <div class="form-actions">
            <a href="/xserv-usuarios" class="btn btn-secondary">
                <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Cancelar
            </a>
            <button type="submit" class="btn btn-primary">
                <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <?= $isEdit ? 'Actualizar Usuario' : 'Crear Usuario' ?>
            </button>
        </div>

        <?= $this->Form->end() ?>
    </div>
</div>

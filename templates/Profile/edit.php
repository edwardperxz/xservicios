<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservUsuario $usuario
 */
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil - Xservicios</title>

<style>
    :root {
        --primary-color: #c9a962;
        --primary-dark: #a88b4a;
        --primary-light: #d4b978;
        --dark-bg: #0d0d0d;
        --dark-card: #1a1a1a;
        --dark-light: #2a2a2a;
        --dark-lighter: #252525;
        --text-white: #ffffff;
        --text-gray: #a0a0a0;
        --text-light-gray: #707070;
        --border-color: rgba(201, 169, 98, 0.2);
        --border-color-strong: rgba(201, 169, 98, 0.3);
        --success-color: #10b981;
        --error-color: #ef4444;
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.2);
        --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.3);
        --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.4);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        background-color: var(--dark-bg);
        color: var(--text-white);
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
        line-height: 1.6;
        background-attachment: fixed;
        background-image: 
            radial-gradient(circle at 20% 50%, rgba(201, 169, 98, 0.08) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(201, 169, 98, 0.05) 0%, transparent 50%);
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Container */
    .edit-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 3rem 1.5rem;
        width: 100%;
        animation: fadeInUp 0.8s ease-out;
    }

    /* Header */
    .edit-header {
        background: linear-gradient(135deg, rgba(201, 169, 98, 0.15) 0%, rgba(201, 169, 98, 0.05) 100%);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        padding: 3rem 2.5rem;
        margin-bottom: 3rem;
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
    }

    .edit-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(201, 169, 98, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .edit-header h1 {
        position: relative;
        z-index: 1;
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        background: linear-gradient(135deg, #d4b978, #c9a962);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .edit-header p {
        position: relative;
        z-index: 1;
        color: var(--text-gray);
        font-size: 1rem;
    }

    /* Form Container */
    .form-card {
        background: linear-gradient(135deg, rgba(26, 26, 26, 0.8) 0%, rgba(26, 26, 26, 0.5) 100%);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 2.5rem;
        box-shadow: var(--shadow-md);
        margin-bottom: 2rem;
    }

    /* Form Groups */
    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 2rem;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-group label {
        display: block;
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-white);
        margin-bottom: 0.6rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .form-group label .required {
        color: var(--error-color);
        margin-left: 0.3rem;
    }

    /* Input Fields */
    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="tel"],
    .form-group textarea {
        background: rgba(255, 255, 255, 0.05);
        border: 1.5px solid var(--border-color);
        border-radius: 12px;
        padding: 1rem 1.2rem;
        font-size: 1rem;
        color: var(--text-white);
        font-family: inherit;
        transition: all 0.3s ease;
    }

    .form-group input[type="text"]:focus,
    .form-group input[type="email"]:focus,
    .form-group input[type="tel"]:focus,
    .form-group textarea:focus {
        outline: none;
        background: rgba(255, 255, 255, 0.08);
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(201, 169, 98, 0.1);
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: rgba(160, 160, 160, 0.5);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 120px;
    }

    /* Form Row (2 columns) */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
    }

    /* Help Text */
    .form-help {
        font-size: 0.85rem;
        color: var(--text-light-gray);
        margin-top: 0.4rem;
    }

    /* Error Messages */
    .form-error {
        color: var(--error-color);
        font-size: 0.85rem;
        margin-top: 0.4rem;
    }

    .form-group.has-error input,
    .form-group.has-error textarea {
        border-color: var(--error-color);
        background: rgba(239, 68, 68, 0.05);
    }

    /* Button Group */
    .form-actions {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
        justify-content: center;
        padding-top: 2rem;
        border-top: 1px solid var(--border-color);
    }

    /* Buttons */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        padding: 1rem 2.5rem;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
        white-space: nowrap;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        min-width: 160px;
    }

    .btn svg {
        width: 20px;
        height: 20px;
        stroke-width: 2;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-color) 100%);
        color: var(--dark-bg);
        box-shadow: 0 8px 24px rgba(201, 169, 98, 0.3);
        border: 2px solid var(--primary-color);
    }

    .btn-primary:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 36px rgba(201, 169, 98, 0.4);
    }

    .btn-primary:active {
        transform: translateY(-2px);
    }

    .btn-secondary {
        background: transparent;
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
    }

    .btn-secondary:hover {
        background: rgba(201, 169, 98, 0.1);
        box-shadow: 0 8px 24px rgba(201, 169, 98, 0.2);
        transform: translateY(-2px);
    }

    .btn-secondary:active {
        transform: translateY(0);
    }

    /* Info Box */
    .info-box {
        background: rgba(201, 169, 98, 0.08);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        display: flex;
        gap: 1rem;
        align-items: flex-start;
    }

    .info-box svg {
        width: 24px;
        height: 24px;
        color: var(--primary-color);
        flex-shrink: 0;
        margin-top: 0.2rem;
    }

    .info-box p {
        font-size: 0.95rem;
        color: var(--text-gray);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .edit-container {
            padding: 2rem 1rem;
        }

        .edit-header {
            padding: 2.5rem 1.5rem;
            margin-bottom: 2rem;
        }

        .edit-header h1 {
            font-size: 1.8rem;
        }

        .form-card {
            padding: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-actions {
            flex-direction: column;
            gap: 1rem;
        }

        .btn {
            width: 100%;
            min-width: unset;
        }
    }

    @media (max-width: 480px) {
        .edit-container {
            padding: 1.5rem 1rem;
        }

        .edit-header {
            padding: 1.5rem 1rem;
        }

        .edit-header h1 {
            font-size: 1.5rem;
        }

        .form-card {
            padding: 1.2rem;
        }

        .form-group label {
            font-size: 0.9rem;
        }

        .form-group input,
        .form-group textarea {
            padding: 0.8rem 1rem;
            font-size: 16px;
        }

            padding: 0.8rem 1.5rem;
            font-size: 0.9rem;
        }
    }

    /* Header Styles */
    .xserv-header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background-color: var(--dark-bg);
        border-bottom: 1px solid var(--border-color-strong);
        z-index: 1000;
        box-shadow: var(--shadow-md);
        backdrop-filter: blur(10px);
    }

    .xserv-header-content {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0.75rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .xserv-logo {
        text-decoration: none;
        color: var(--text-white);
        font-weight: 700;
        font-size: 1.3rem;
        letter-spacing: -0.5px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .xserv-logo-x {
        color: var(--primary-color);
        font-weight: 800;
    }

    .xserv-nav-menu {
        display: flex;
        gap: 2rem;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .xserv-nav-item {
        color: var(--text-gray);
        text-decoration: none;
        font-size: 0.95rem;
        transition: color 0.3s ease;
        cursor: pointer;
    }

    .xserv-nav-item:hover {
        color: var(--primary-color);
    }

    .xserv-user-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .xserv-lang-button {
        background: none;
        border: none;
        color: var(--text-gray);
        cursor: pointer;
        font-size: 1.2rem;
        transition: color 0.3s ease;
        padding: 0.5rem;
    }

    .xserv-lang-button:hover {
        color: var(--primary-color);
    }

    #xservLoginBtn {
        background-color: var(--primary-color);
        color: var(--dark-bg);
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }

    #xservLoginBtn:hover {
        background-color: var(--primary-light);
    }

    .xserv-user-profile {
        position: relative;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        cursor: pointer;
    }

    .xserv-user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--dark-bg);
        font-weight: 600;
        font-size: 0.9rem;
    }

    .xserv-user-name {
        color: var(--text-white);
        font-weight: 500;
        max-width: 100px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .xserv-dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background-color: var(--dark-card);
        border: 1px solid var(--border-color-strong);
        border-radius: 12px;
        margin-top: 1rem;
        min-width: 220px;
        box-shadow: var(--shadow-lg);
        z-index: 1001;
    }

    .xserv-dropdown-menu.is-active {
        display: block;
    }

    .xserv-dropdown-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.875rem 1.25rem;
        color: var(--text-white);
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
        width: 100%;
        text-align: left;
        background: none;
    }

    .xserv-dropdown-item:hover {
        background-color: var(--dark-light);
        color: var(--primary-color);
    }

    .xserv-dropdown-item:first-child {
        border-radius: 12px 12px 0 0;
    }

    .xserv-dropdown-item:last-child {
        border-radius: 0 0 12px 12px;
        border-top: 1px solid var(--border-color);
        color: var(--error-color);
    }

    .xserv-dropdown-item svg {
        width: 18px;
        height: 18px;
    }

    @media (max-width: 768px) {
        .xserv-header-content {
            padding: 0.5rem 1rem;
        }

        .xserv-nav-menu {
            display: none;
        }

        .xserv-logo {
            font-size: 1.1rem;
        }

        .xserv-user-name {
            display: none;
        }
    }
</style>
</head>
<body>
    <header class="xserv-header">
        <div class="xserv-header-content">
            <a href="/home" class="xserv-logo">
                <span class="xserv-logo-x">X</span>SERVICIOS
            </a>
            <nav class="xserv-nav-menu">
                <a href="/home" class="xserv-nav-item">Inicio</a>
                <a href="#" class="xserv-nav-item">Ver flota</a>
                <a href="#" class="xserv-nav-item">Servicios</a>
                <a href="#" class="xserv-nav-item">Nosotros</a>
            </nav>
            <div class="xserv-user-actions">
                <button type="button" id="langToggle" class="xserv-lang-button" title="Cambiar idioma">🌐</button>
                <button type="button" id="xservLoginBtn" style="display: none;">Iniciar Sesión</button>
                <div class="xserv-user-profile" id="xservUserProfile" style="display: none;">
                    <div class="xserv-user-avatar" id="xservUserAvatar">U</div>
                    <span class="xserv-user-name" id="xservUserName">Usuario</span>
                    <div class="xserv-dropdown-menu" id="xservDropdownMenu">
                        <a href="/profile" class="xserv-dropdown-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Mi Perfil
                        </a>
                        <a href="#" class="xserv-dropdown-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Mis Reservas
                        </a>
                        <a href="#" class="xserv-dropdown-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            Valorar Servicio
                        </a>
                        <a href="#" class="xserv-dropdown-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            </svg>
                            Configuración
                        </a>
                        <button type="button" class="xserv-dropdown-item" id="xservLogoutBtn">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Cerrar Sesión
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

<div class="edit-container" style="padding-top: 8rem;">
    <!-- Header -->
    <div class="edit-header">
        <h1>Editar Mi Perfil</h1>
        <p>Actualiza tu información personal</p>
    </div>

    <!-- Info Box -->
    <div class="info-box">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <p>Los campos marcados con <span style="color: var(--error-color);">*</span> son obligatorios</p>
    </div>

    <!-- Form -->
    <div class="form-card">
        <?= $this->Form->create($usuario, ['method' => 'post']) ?>

        <div class="form-row">
            <!-- Full Name -->
            <div class="form-group">
                <label for="nombre">
                    Nombre Completo
                    <span class="required">*</span>
                </label>
                <?= $this->Form->text('nombre', [
                    'id' => 'nombre',
                    'class' => 'form-input',
                    'placeholder' => 'Ej: Juan Pérez',
                    'required' => true
                ]) ?>
                <?php if ($this->Form->isFieldError('nombre')): ?>
                    <div class="form-error">
                        <?= implode(', ', $this->Form->getFieldError('nombre')) ?>
                    </div>
                <?php endif; ?>
                <span class="form-help">Tu nombre completo</span>
            </div>

            <!-- Username -->
            <div class="form-group">
                <label for="username">
                    Usuario
                    <span class="required">*</span>
                </label>
                <?= $this->Form->text('username', [
                    'id' => 'username',
                    'class' => 'form-input',
                    'placeholder' => 'Ej: juanperez',
                    'required' => true
                ]) ?>
                <?php if ($this->Form->isFieldError('username')): ?>
                    <div class="form-error">
                        <?= implode(', ', $this->Form->getFieldError('username')) ?>
                    </div>
                <?php endif; ?>
                <span class="form-help">Tu nombre de usuario único</span>
            </div>
        </div>

        <div class="form-row">
            <!-- Email -->
            <div class="form-group">
                <label for="correo">
                    Correo Electrónico
                    <span class="required">*</span>
                </label>
                <?= $this->Form->email('correo', [
                    'id' => 'correo',
                    'class' => 'form-input',
                    'placeholder' => 'Ej: juan@ejemplo.com',
                    'required' => true
                ]) ?>
                <?php if ($this->Form->isFieldError('correo')): ?>
                    <div class="form-error">
                        <?= implode(', ', $this->Form->getFieldError('correo')) ?>
                    </div>
                <?php endif; ?>
                <span class="form-help">Tu correo electrónico de contacto</span>
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label for="telefono">
                    Teléfono
                </label>
                <?= $this->Form->telephone('telefono', [
                    'id' => 'telefono',
                    'class' => 'form-input',
                    'placeholder' => 'Ej: +34 666 123 456'
                ]) ?>
                <?php if ($this->Form->isFieldError('telefono')): ?>
                    <div class="form-error">
                        <?= implode(', ', $this->Form->getFieldError('telefono')) ?>
                    </div>
                <?php endif; ?>
                <span class="form-help">Tu número de teléfono de contacto</span>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <?= $this->Form->button(
                '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Guardar Cambios',
                [
                    'type' => 'submit',
                    'class' => 'btn btn-primary',
                    'escape' => false
                ]
            ) ?>
            <?= $this->Html->link(
                '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>Cancelar',
                ['action' => 'index'],
                [
                    'class' => 'btn btn-secondary',
                    'escape' => false
                ]
            ) ?>
        </div>

        <?= $this->Form->end() ?>
    </div>
</div>

<script src="/js/i18n.js"></script>
<script src="/js/header-dynamic.js"></script>
</body>
</html>

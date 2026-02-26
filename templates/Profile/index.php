<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservUsuario $usuario
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrfToken" content="<?= $this->request->getAttribute('csrfToken') ?>">
  <title>Mi Perfil - Xservicios</title>
  
  <!-- Pre-load language from localStorage to avoid flash -->
  <script src="/js/i18n-preload.js"></script>
  
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      --gold: #c9a962;
      --gold-light: #d4b978;
      --gold-dark: #a88b4a;
      --dark-bg: #0d0d0d;
      --dark-card: #1a1a1a;
      --dark-lighter: #2a2a2a;
      --text-white: #ffffff;
      --text-gray: #a0a0a0;
      --primary-color: #c9a962;
      --primary-dark: #a88b4a;
      --primary-light: #d4b978;
      --secondary-color: #1a1a1a;
      --text-light-gray: #707070;
      --border-color: rgba(201, 169, 98, 0.2);
      --border-color-strong: rgba(201, 169, 98, 0.3);
      --success-color: #10b981;
      --error-color: #ef4444;
      --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.2);
      --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.3);
      --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.4);
    }

    body {
      background-color: var(--dark-bg);
      color: var(--text-white);
      font-family: 'Inter', sans-serif;
      min-height: 100vh;
      background-image: 
        radial-gradient(circle at 20% 50%, rgba(201, 169, 98, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(201, 169, 98, 0.05) 0%, transparent 50%);
    }

    html { scroll-behavior: smooth; }

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

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes pulse {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(201, 169, 98, 0.4);
        }
        50% {
            box-shadow: 0 0 0 10px rgba(201, 169, 98, 0);
        }
    }

    /* Container */
    .profile-container {
        max-width: 1150px;
        margin: 0 auto;
        padding: 3rem 1.5rem;
        width: 100%;
        animation: fadeInUp 0.8s ease-out;
    }

    /* ===== PROFILE HEADER ===== */
    .profile-header {
        background: linear-gradient(135deg, rgba(201, 169, 98, 0.15) 0%, rgba(201, 169, 98, 0.05) 100%);
        border: 1px solid var(--border-color);
        border-radius: 24px;
        padding: 4rem 3rem;
        margin-bottom: 3rem;
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .profile-header::before {
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

    .profile-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(201, 169, 98, 0.08) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .profile-header__content {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 2.5rem;
        flex-wrap: wrap;
    }

    .profile-avatar {
        width: 140px;
        height: 140px;
        min-width: 140px;
        background: linear-gradient(135deg, #d4b978 0%, #c9a962 50%, #a88b4a 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--dark-bg);
        box-shadow: 0 12px 36px rgba(201, 169, 98, 0.35);
        border: 3px solid rgba(255, 255, 255, 0.1);
        animation: slideInLeft 0.8s ease-out;
    }

    .profile-avatar:hover {
        animation: pulse 2s infinite;
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }

    .profile-info {
        flex: 1;
        min-width: 280px;
        animation: slideInRight 0.8s ease-out;
    }

    .profile-info h1 {
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 0.8rem;
        background: linear-gradient(135deg, var(--primary-light), var(--primary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .profile-meta {
        display: flex;
        gap: 2rem;
        margin-top: 1.2rem;
        flex-wrap: wrap;
    }

    .profile-meta-item {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        color: var(--text-gray);
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .profile-meta-item:hover {
        color: var(--primary-color);
        transform: translateX(4px);
    }

    .profile-meta-item svg {
        width: 20px;
        height: 20px;
        stroke-width: 2;
    }

    .profile-meta-item strong {
        color: var(--text-white);
        font-weight: 600;
    }

    /* ===== QUICK STATS GRID ===== */
    .profile-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .profile-card {
        background: linear-gradient(135deg, rgba(201, 169, 98, 0.08) 0%, rgba(201, 169, 98, 0.02) 100%);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: var(--shadow-md);
        transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .profile-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: left 0.5s ease;
    }

    .profile-card:hover::before {
        left: 100%;
    }

    .profile-card:hover {
        transform: translateY(-8px) translateX(-2px);
        border-color: var(--border-color-strong);
        box-shadow: 0 25px 50px rgba(201, 169, 98, 0.15);
        background: linear-gradient(135deg, rgba(201, 169, 98, 0.12) 0%, rgba(201, 169, 98, 0.04) 100%);
    }

    .profile-card h3 {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-gray);
        margin-bottom: 1.2rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .profile-card h3 svg {
        width: 22px;
        height: 22px;
        stroke-width: 2;
        color: var(--primary-color);
    }

    .profile-card-value {
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--text-white);
        word-break: break-word;
    }

    /* ===== STATUS & BADGES ===== */
    .status-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-badge.active {
        background: rgba(16, 185, 129, 0.15);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .status-badge.inactive {
        background: rgba(239, 68, 68, 0.15);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .profile-badge {
        display: inline-block;
        background: linear-gradient(135deg, rgba(201, 169, 98, 0.2) 0%, rgba(201, 169, 98, 0.1) 100%);
        color: var(--primary-color);
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        border: 1px solid var(--border-color);
        text-transform: capitalize;
    }

    /* ===== TWO COLUMN SECTIONS ===== */
    .profile-two-col {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .profile-section {
        background: linear-gradient(135deg, rgba(26, 26, 26, 0.8) 0%, rgba(26, 26, 26, 0.5) 100%);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: var(--shadow-md);
        transition: all 0.4s ease;
        animation: fadeInUp 0.8s ease-out;
    }

    .profile-section:hover {
        border-color: var(--border-color-strong);
        box-shadow: 0 15px 40px rgba(201, 169, 98, 0.1);
        transform: translateY(-4px);
    }

    .profile-section-header {
        margin-bottom: 1.8rem;
        padding-bottom: 1.2rem;
        border-bottom: 2px solid var(--border-color);
    }

    .profile-section-header h2 {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--text-white);
    }

    .profile-section-header h2 svg {
        width: 24px;
        height: 24px;
        color: var(--primary-color);
    }

    .profile-section-content {
        display: flex;
        flex-direction: column;
        gap: 1.2rem;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.02);
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    .info-row:hover {
        background: rgba(201, 169, 98, 0.05);
        border-color: var(--border-color);
    }

    .info-label {
        font-size: 0.95rem;
        color: var(--text-gray);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .info-value {
        font-size: 1.1rem;
        color: var(--text-white);
        font-weight: 500;
        text-align: right;
    }

    /* ===== ACTION BUTTONS ===== */
    .profile-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        justify-content: center;
        padding: 2rem 0;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        padding: 1rem 2rem;
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
        box-shadow: inset 0 0 0 0 rgba(201, 169, 98, 0.1);
    }

    .btn-secondary:hover {
        background: rgba(201, 169, 98, 0.1);
        box-shadow: 0 8px 24px rgba(201, 169, 98, 0.2);
        transform: translateY(-2px);
    }

    .btn-secondary:active {
        transform: translateY(0);
    }

    /* ===== RESPONSIVE DESIGN ===== */
    @media (max-width: 768px) {
        .profile-container {
            padding: 2rem 1rem;
        }

        .profile-header {
            padding: 2.5rem 1.5rem;
            margin-bottom: 2rem;
        }

        .profile-header__content {
            flex-direction: column;
            text-align: center;
            gap: 1.5rem;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            min-width: 100px;
            font-size: 2.5rem;
        }

        .profile-info h1 {
            font-size: 1.8rem;
        }

        .profile-meta {
            justify-content: center;
            gap: 1.5rem;
        }

        .profile-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .profile-two-col {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .profile-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            padding: 0.9rem 1.5rem;
            font-size: 0.95rem;
        }

        .info-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .info-value {
            text-align: left;
        }
    }

    @media (max-width: 480px) {
        .profile-container {
            padding: 1.5rem 1rem;
        }

        .profile-header {
            padding: 1.5rem 1rem;
            margin-bottom: 1.5rem;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            font-size: 2rem;
        }

        .profile-info h1 {
            font-size: 1.5rem;
        }

        .profile-meta {
            flex-direction: column;
            gap: 0.8rem;
            align-items: center;
        }

        .profile-card {
            padding: 1.5rem;
        }

        .profile-card h3 {
            font-size: 0.9rem;
        }

        .profile-card-value {
            font-size: 1.3rem;
        }

        .profile-section {
            padding: 1.5rem;
        }

        .profile-section-header h2 {
            font-size: 1.1rem;
        }

        .btn {
            padding: 0.8rem 1.2rem;
            font-size: 0.9rem;
        }
    }
</style>
</head>
<body>
    <!-- Header se carga con header-loader.js -->

<div class="profile-container" style="padding-top: 8rem;">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-header__content">
            <div class="profile-avatar">
                <?php
                $nombre = $usuario['nombre'] ?? $usuario['username'] ?? 'US';
                $partes = explode(' ', trim($nombre));
                if (count($partes) >= 2) {
                    echo strtoupper(substr($partes[0], 0, 1) . substr($partes[1], 0, 1));
                } else {
                    echo strtoupper(substr($nombre, 0, 2));
                }
                ?>
            </div>
            <div class="profile-info">
                <h1><?= h($usuario['nombre'] ?? $usuario['username']) ?></h1>
                <div class="profile-meta">
                    <div class="profile-meta-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <strong><?= h($usuario['correo'] ?? 'N/A') ?></strong>
                    </div>
                    <div class="profile-meta-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="profile-badge"><?= h($usuario['rol'] ?? 'Usuario') ?></span>
                    </div>
                    <div class="profile-meta-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <?php if ($usuario['estado'] ?? false): ?>
                            <span class="status-badge active">Activo</span>
                        <?php else: ?>
                            <span class="status-badge inactive">Inactivo</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="profile-grid">
        <div class="profile-card">
            <h3>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Estado
            </h3>
            <div class="profile-card-value">
                <?php if ($usuario['estado'] ?? false): ?>
                    <span class="status-badge active">Activo</span>
                <?php else: ?>
                    <span class="status-badge inactive">Inactivo</span>
                <?php endif; ?>
            </div>
        </div>

        <div class="profile-card">
            <h3>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Miembro desde
            </h3>
            <div class="profile-card-value">
                <?= $usuario['created_at'] ? $usuario['created_at']->format('d/m/Y') : 'N/A' ?>
            </div>
        </div>

        <div class="profile-card">
            <h3>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                ID de Usuario
            </h3>
            <div class="profile-card-value">#<?= h($usuario['id']) ?></div>
        </div>
    </div>

    <!-- Detailed Information -->
    <div class="profile-two-col">
        <!-- Personal Information -->
        <div class="profile-section">
            <div class="profile-section-header">
                <h2>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Información Personal
                </h2>
            </div>
            <div class="profile-section-content">
                <div class="info-row">
                    <span class="info-label">Nombre</span>
                    <span class="info-value"><?= h($usuario['nombre'] ?? 'N/A') ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Usuario</span>
                    <span class="info-value"><?= h($usuario['username'] ?? 'N/A') ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email</span>
                    <span class="info-value"><?= h($usuario['correo'] ?? 'N/A') ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Teléfono</span>
                    <span class="info-value"><?= h($usuario['telefono'] ?? 'N/A') ?></span>
                </div>
            </div>
        </div>

        <!-- Account Information -->
        <div class="profile-section">
            <div class="profile-section-header">
                <h2>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Información de Cuenta
                </h2>
            </div>
            <div class="profile-section-content">
                <div class="info-row">
                    <span class="info-label">Rol</span>
                    <span class="info-value">
                        <span class="profile-badge"><?= h($usuario['rol'] ?? 'Usuario') ?></span>
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Estado</span>
                    <span class="info-value">
                        <?php if ($usuario['estado'] ?? false): ?>
                            <span class="status-badge active">Activo</span>
                        <?php else: ?>
                            <span class="status-badge inactive">Inactivo</span>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Creado</span>
                    <span class="info-value"><?= $usuario['created_at'] ? $usuario['created_at']->format('d/m/Y H:i') : 'N/A' ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Actualizado</span>
                    <span class="info-value"><?= $usuario['updated_at'] ? $usuario['updated_at']->format('d/m/Y H:i') : 'N/A' ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="profile-actions">
        <?= $this->Html->link(
            '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>Editar Perfil',
            ['action' => 'edit'],
            ['class' => 'btn btn-primary', 'escape' => false]
        ) ?>
        <?= $this->Html->link(
            '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>Cambiar Contraseña',
            ['controller' => 'XservUsuarios', 'action' => 'changePassword'],
            ['class' => 'btn btn-secondary', 'escape' => false]
        ) ?>
        <?= $this->Html->link(
            '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>Volver',
            ['controller' => 'Home', 'action' => 'index'],
            ['class' => 'btn btn-secondary', 'escape' => false]
        ) ?>
    </div>
</div>

<script src="/js/i18n.js"></script>
<script src="/js/header-loader.js"></script>
<script src="/js/header-dynamic.js"></script>
</body>
</html>

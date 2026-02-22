<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Xservicios - Transporte Turístico de Lujo en Chiriquí</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            --green: #4ade80;
            --orange: #f59e0b;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--dark-bg);
            color: var(--text-white);
            min-height: 100vh;
        }

        /* Header */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 2.5rem;
            background: linear-gradient(to bottom, rgba(0,0,0,0.8), transparent);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 1.5rem;
            letter-spacing: 2px;
            color: var(--text-white);
            text-decoration: none;
        }

        .logo-x {
            color: var(--gold);
            font-size: 1.8rem;
            font-weight: 700;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            min-width: 90px;
            color: var(--text-gray);
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.3s;
        }

        .nav-item:hover {
            color: var(--gold);
        }

        .nav-icon {
            width: 18px;
            height: 18px;
            stroke: currentColor;
            fill: none;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .lang-selector {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-gray);
            font-size: 0.875rem;
        }

        .lang-selector span.active {
            color: var(--text-white);
        }

        .header-icon {
            width: 20px;
            height: 20px;
            stroke: var(--gold);
            fill: none;
            cursor: pointer;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .user-name {
            font-size: 0.875rem;
            color: var(--text-white);
        }

        /* Flash Messages */
        .flash-container {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 12px;
            align-items: center;
            width: min(520px, calc(100% - 32px));
            pointer-events: none;
        }

        .message {
            width: 100%;
            padding: 14px 18px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(26, 26, 26, 0.95);
            pointer-events: auto;
        }

        .message.success {
            background-color: rgba(74, 124, 89, 0.2);
            color: #4ade80;
            border: 1px solid rgba(74, 124, 89, 0.45);
        }

        .message.error {
            background-color: rgba(231, 76, 60, 0.18);
            color: #f87171;
            border: 1px solid rgba(231, 76, 60, 0.45);
        }

        .message.warning {
            background-color: rgba(245, 158, 11, 0.18);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.45);
        }

        .message.info {
            background-color: rgba(59, 130, 246, 0.18);
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, 0.45);
        }

        .message.hidden {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <a href="<?= $this->Url->build('/') ?>" class="logo">
            <span class="logo-x">X</span>SERVICIOS
        </a>

        <nav class="nav-menu">
            <a href="<?= $this->Url->build(['controller' => 'XservReservas', 'action' => 'add']) ?>" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24" stroke-width="2">
                    <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9L18 10l-1.9-4.6c-.3-.7-1-1.4-1.8-1.4H9.7c-.8 0-1.5.5-1.8 1.2L6 10l-2.5 1.1C2.7 11.3 2 12.1 2 13v3c0 .6.4 1 1 1h2"/>
                    <circle cx="7" cy="17" r="2"/>
                    <circle cx="17" cy="17" r="2"/>
                </svg>
                Nueva Reserva
            </a>
            <a href="<?= $this->Url->build(['controller' => 'XservReservas', 'action' => 'index']) ?>" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                Mis Reservas
            </a>
            <a href="<?= $this->Url->build(['controller' => 'XservValoraciones', 'action' => 'add']) ?>" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24" stroke-width="2">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
                Valorar Servicio
            </a>
        </nav>

        <div class="header-right">
            <div class="lang-selector">
                <svg class="header-icon" viewBox="0 0 24 24" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                <span class="active">ES</span>
                <span>|</span>
                <span>EN</span>
            </div>

            <svg class="header-icon" viewBox="0 0 24 24" stroke-width="2">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>

            <?php if ($this->request->getAttribute('identity')): ?>
                <a href="<?= $this->Url->build(['controller' => 'XservUsuarios', 'action' => 'profile']) ?>" class="user-profile" style="text-decoration: none;">
                    <div class="user-avatar">US</div>
                    <span class="user-name">Usuario</span>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </a>
            <?php else: ?>
                <a href="<?= $this->Url->build(['controller' => 'XservUsuarios', 'action' => 'login']) ?>" class="user-profile" style="text-decoration: none;">
                    <div class="user-avatar">?</div>
                    <span class="user-name">Iniciar Sesión</span>
                </a>
            <?php endif; ?>
        </div>
    </header>

    <div class="flash-container">
        <?= $this->Flash->render() ?>
    </div>
    <?= $this->fetch('content') ?>
    <script src="/js/i18n.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessages = document.querySelectorAll('.message');
            if (flashMessages.length) {
                flashMessages.forEach(message => {
                    setTimeout(() => {
                        message.style.transition = 'opacity 0.3s ease';
                        message.style.opacity = '0';
                        setTimeout(() => {
                            message.remove();
                        }, 300);
                    }, 5000);
                });
            }
        });
    </script>
</body>
</html>

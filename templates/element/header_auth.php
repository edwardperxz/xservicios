<script src="/js/header-auth.js"></script>
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
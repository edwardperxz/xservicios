<?php
// Obtener información del usuario autenticado
$identity = $this->request->getAttribute('identity');
$userName = $identity ? $identity->username : 'Usuario';
$userRole = $identity ? ($identity->rol ?? 'Admin') : 'Admin';
$userInitial = strtoupper(substr($userName, 0, 1));

// Determinar URLs según el rol
$isAdmin = $userRole === 'admin';
$isOperador = $userRole === 'operador';
$dashboardUrl = $isAdmin ? '/panel/admin' : '/panel/operador';
$roleLabel = $isAdmin ? 'Administrador' : ($isOperador ? 'Operador' : ucfirst($userRole));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $this->fetch('title', 'Panel de Administración - Xservicios') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= $this->request->getAttribute('csrfToken') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <?= $this->fetch('css') ?>
    
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
            --red: #ef4444;
            --blue: #3b82f6;
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--dark-bg);
            color: var(--text-white);
            min-height: 100vh;
        }

        /* Prevenir scroll cuando sidebar está abierto en móvil */
        body.sidebar-open {
            overflow: hidden !important;
            position: fixed;
            width: 100%;
        }

        body.sidebar-open .admin-main {
            overflow: hidden;
        }

        /* Layout principal */
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Menú Hamburguesa */
        .menu-toggle {
            display: none;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
            color: var(--text-white);
            transition: all 0.3s;
        }

        .menu-toggle:hover {
            color: var(--gold);
        }

        .menu-toggle svg {
            width: 28px;
            height: 28px;
        }

        /* Overlay para móvil */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 99;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        /* Sidebar */
        .admin-sidebar {
            width: var(--sidebar-width);
            background: var(--dark-card);
            border-right: 1px solid var(--dark-lighter);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 100;
            transition: transform 0.3s ease;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--dark-lighter);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.25rem;
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

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-section {
            margin-bottom: 1.5rem;
        }

        .nav-section-title {
            padding: 0.5rem 1.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-gray);
            letter-spacing: 0.5px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.5rem;
            color: var(--text-gray);
            text-decoration: none;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .nav-item:hover {
            background: var(--dark-lighter);
            color: var(--text-white);
        }

        .nav-item.active {
            background: var(--dark-lighter);
            color: var(--gold);
            border-left-color: var(--gold);
        }

        .nav-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        /* Main Content */
        .admin-main {
            margin-left: var(--sidebar-width);
            flex: 1;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        /* Header */
        .admin-header {
            background: var(--dark-card);
            border-bottom: 1px solid var(--dark-lighter);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex: 1;
            min-width: 0;
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            flex-shrink: 0;
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 500;
            font-size: 0.875rem;
            white-space: nowrap;
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--text-gray);
            text-transform: capitalize;
            white-space: nowrap;
        }

        .btn-logout {
            padding: 0.5rem 1rem;
            background: transparent;
            border: 1px solid var(--gold);
            color: var(--gold);
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.875rem;
            text-decoration: none;
            display: inline-block;
            white-space: nowrap;
        }

        .btn-logout:hover {
            background: var(--gold);
            color: var(--dark-bg);
        }

        /* Content Area */
        .admin-content {
            padding: 2rem;
        }

        /* Flash Messages */
        .flash-container {
            position: fixed;
            top: 90px;
            right: 20px;
            z-index: 1000;
            max-width: 400px;
        }

        .flash-message {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .flash-success {
            background: var(--green);
            color: var(--dark-bg);
        }

        .flash-error {
            background: var(--red);
            color: var(--text-white);
        }

        .flash-warning {
            background: var(--orange);
            color: var(--dark-bg);
        }

        .flash-info {
            background: var(--blue);
            color: var(--text-white);
        }

        /* Scrollbar */
        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .admin-sidebar::-webkit-scrollbar-track {
            background: var(--dark-card);
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: var(--dark-lighter);
            border-radius: 3px;
        }

        .admin-sidebar::-webkit-scrollbar-thumb:hover {
            background: var(--gold-dark);
        }

        /* Responsive - Tablet y Móvil */
        @media (max-width: 1024px) {
            .menu-toggle {
                display: block;
            }

            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.open {
                transform: translateX(0);
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.5);
            }

            .admin-main {
                margin-left: 0;
            }

            .admin-header {
                padding: 1rem 1.5rem;
            }

            .header-title {
                font-size: 1.25rem;
            }

            .admin-content {
                padding: 1.5rem;
            }

            .flash-container {
                right: 10px;
                left: 10px;
                max-width: none;
            }
        }

        @media (max-width: 768px) {
            .admin-header {
                padding: 0.875rem 1rem;
            }

            .header-title {
                font-size: 1.125rem;
            }

            .user-details {
                display: none;
            }

            .header-right {
                gap: 1rem;
            }

            .btn-logout {
                padding: 0.5rem 0.75rem;
                font-size: 0.8125rem;
            }

            .admin-content {
                padding: 1rem;
            }

            .user-avatar {
                width: 36px;
                height: 36px;
            }

            .nav-item {
                padding: 0.875rem 1.25rem;
            }

            .nav-section-title {
                padding: 0.5rem 1.25rem;
            }
        }

        @media (max-width: 480px) {
            .admin-header {
                padding: 0.75rem;
            }

            .header-title {
                font-size: 1rem;
            }

            .btn-logout {
                padding: 0.5rem;
                font-size: 0.75rem;
            }

            .admin-content {
                padding: 0.75rem;
            }

            .user-avatar {
                width: 32px;
                height: 32px;
                font-size: 0.875rem;
            }

            .flash-container {
                top: 80px;
            }

            .flash-message {
                padding: 0.75rem 1rem;
                font-size: 0.875rem;
            }
        }
    </style>
</head>
<body>
    <!-- Overlay para cerrar sidebar en móvil -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="sidebar-header">
                <a href="<?= $dashboardUrl ?>" class="logo">
                    <span class="logo-x">X</span><span>SERVICIOS</span>
                </a>
            </div>
            
            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Principal</div>
                    <a href="<?= $dashboardUrl ?>" class="nav-item <?= in_array($this->request->getParam('action'), ['adminPanel', 'operadorPanel']) ? 'active' : '' ?>">
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Dashboard
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Gestión</div>
                    <?php if ($isAdmin): ?>
                    <a href="/xserv-usuarios" class="nav-item <?= $this->request->getParam('controller') === 'XservUsuarios' ? 'active' : '' ?>">
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        Usuarios y Roles
                    </a>
                    <?php endif; ?>
                    <a href="/xserv-choferes" class="nav-item <?= $this->request->getParam('controller') === 'XservChoferes' ? 'active' : '' ?>">
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Choferes
                    </a>
                    <a href="/xserv-vehiculos" class="nav-item <?= $this->request->getParam('controller') === 'XservVehiculos' ? 'active' : '' ?>">
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        Flota Vehicular
                    </a>
                    <a href="/xserv-clientes" class="nav-item <?= $this->request->getParam('controller') === 'XservClientes' ? 'active' : '' ?>">
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Clientes
                    </a>
                </div>

                <?php if ($isAdmin): ?>
                <div class="nav-section">
                    <div class="nav-section-title">Catálogo</div>
                    <a href="/xserv-servicios" class="nav-item <?= $this->request->getParam('controller') === 'XservServicios' ? 'active' : '' ?>">
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Servicios
                    </a>
                    <a href="/xserv-destinos" class="nav-item <?= $this->request->getParam('controller') === 'XservDestinos' ? 'active' : '' ?>">
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Destinos
                    </a>
                    <a href="/xserv-ubicaciones" class="nav-item <?= $this->request->getParam('controller') === 'XservUbicaciones' ? 'active' : '' ?>">
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                        Ubicaciones
                    </a>
                </div>
                <?php endif; ?>

                <div class="nav-section">
                    <div class="nav-section-title">Operaciones</div>
                    <a href="/xserv-reservas" class="nav-item <?= $this->request->getParam('controller') === 'XservReservas' ? 'active' : '' ?>">
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Reservaciones
                    </a>
                    <a href="/xserv-asignaciones" class="nav-item <?= $this->request->getParam('controller') === 'XservAsignaciones' ? 'active' : '' ?>">
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                        Asignaciones
                    </a>
                    <a href="/xserv-ejecucion-viajes" class="nav-item <?= $this->request->getParam('controller') === 'XservEjecucionViajes' ? 'active' : '' ?>">
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Control Operativo
                    </a>
                    <a href="/xserv-incidencias-viaje" class="nav-item <?= $this->request->getParam('controller') === 'XservIncidenciasViaje' ? 'active' : '' ?>">
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        Incidencias
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Comunicación</div>
                    <a href="/xserv-notificaciones" class="nav-item <?= $this->request->getParam('controller') === 'XservNotificaciones' ? 'active' : '' ?>">
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        Notificaciones
                    </a>
                    <a href="/xserv-valoraciones" class="nav-item <?= $this->request->getParam('controller') === 'XservValoraciones' ? 'active' : '' ?>">
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        Valoraciones
                    </a>
                </div>

                <?php if ($isAdmin): ?>
                <div class="nav-section">
                    <div class="nav-section-title">Configuración</div>
                    <a href="/xserv-configuraciones" class="nav-item <?= $this->request->getParam('controller') === 'XservConfiguraciones' ? 'active' : '' ?>">
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Configuración
                    </a>
                    <a href="/dashboard/reportes" class="nav-item <?= $this->request->getParam('action') === 'reportes' ? 'active' : '' ?>">
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Reportes
                    </a>
                </div>
                <?php endif; ?>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <!-- Header -->
            <header class="admin-header">
                <div class="header-left">
                    <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <h1 class="header-title"><?= $this->fetch('header-title', 'Dashboard') ?></h1>
                </div>
                
                <div class="header-right">
                    <div class="user-info">
                        <div class="user-avatar">
                            <?= $userInitial ?>
                        </div>
                        <div class="user-details">
                            <div class="user-name"><?= h($userName) ?></div>
                            <div class="user-role"><?= h($roleLabel) ?></div>
                        </div>
                    </div>
                    <?= $this->Form->postLink('Cerrar Sesión', ['controller' => 'XservUsuarios', 'action' => 'logout'], ['class' => 'btn-logout']) ?>
                </div>
            </header>

            <!-- Flash Messages -->
            <?php if ($this->Flash->render()): ?>
            <div class="flash-container">
                <?= $this->Flash->render() ?>
            </div>
            <?php endif; ?>

            <!-- Content -->
            <div class="admin-content">
                <?= $this->fetch('content') ?>
            </div>
        </main>
    </div>

    <?= $this->fetch('script') ?>
    
    <script>
        // Toggle del menú hamburguesa
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        
        function toggleSidebar() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
            document.body.classList.toggle('sidebar-open');
        }
        
        function closeSidebar() {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
            document.body.classList.remove('sidebar-open');
        }
        
        // Toggle al hacer clic en el botón
        menuToggle.addEventListener('click', toggleSidebar);
        
        // Cerrar al hacer clic en el overlay
        overlay.addEventListener('click', closeSidebar);
        
        // Cerrar al hacer clic en un enlace del menú en móvil
        const navItems = document.querySelectorAll('.nav-item');
        navItems.forEach(item => {
            item.addEventListener('click', () => {
                if (window.innerWidth <= 1024) {
                    closeSidebar();
                }
            });
        });
        
        // Cerrar sidebar al cambiar de tamaño de pantalla
        window.addEventListener('resize', () => {
            if (window.innerWidth > 1024) {
                closeSidebar();
            }
        });
        
        // Prevenir scroll del body cuando el sidebar está abierto
        sidebar.addEventListener('touchmove', (e) => {
            if (sidebar.classList.contains('open')) {
                e.stopPropagation();
            }
        }, { passive: true });
    </script>
</html>

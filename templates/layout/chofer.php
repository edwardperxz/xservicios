<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Xservicios - Perfil Chofer</title>
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<style>
		* { margin: 0; padding: 0; box-sizing: border-box; }

		body {
			font-family: 'Inter', sans-serif;
			background-color: var(--dark-deep);
			color: var(--text-white);
			min-height: 100vh;
		}

		/* ===================== HEADER ===================== */
		.header {
			display: flex;
			align-items: center;
			padding: 1rem 2.5rem;
			background: linear-gradient(to bottom, rgba(10,10,10,0.98), rgba(5,5,5,0.95));
			border-bottom: 1px solid rgba(201,169,98,0.3);
			position: sticky;
			top: 0;
			z-index: 100;
		}
		.logo { display: flex; align-items: center; flex-shrink: 0; }
		.logo-x { font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 700; color: var(--gold); text-shadow: 0 0 10px rgba(201,169,98,0.5); }
		.logo-text { font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 600; color: var(--text-white); letter-spacing: 0.5px; }
		.nav-menu { display: flex; align-items: center; gap: 2rem; margin-left: 4rem; margin-right: 4rem; }
		.nav-item { display: flex; align-items: center; gap: 0.4rem; color: var(--text-gray); text-decoration: none; font-size: 0.85rem; transition: color 0.3s; white-space: nowrap; }
		.nav-item:hover, .nav-item.active { color: var(--gold); }
		.nav-icon { width: 16px; height: 16px; stroke: currentColor; fill: none; flex-shrink: 0; }
		.user-actions { display: flex; align-items: center; gap: 1.25rem; margin-left: auto; }
		.lang-selector { display: flex; align-items: center; gap: 0.4rem; color: var(--text-gray); font-size: 0.8rem; }
		.lang-icon { width: 14px; height: 14px; stroke: var(--gold); fill: none; }
		.lang-text { color: var(--text-gray); cursor: pointer; transition: color 0.3s; font-size: 0.8rem; }
		.lang-text:hover { color: var(--gold); }
		.lang-divider { color: rgba(160,160,160,0.3); font-size: 0.8rem; }
		.notification-icon { position: relative; cursor: pointer; }
		.notification-icon svg { width: 18px; height: 18px; stroke: var(--text-gray); fill: none; transition: stroke 0.3s; }
		.notification-icon:hover svg { stroke: var(--gold); }
		.user-profile { display: flex; align-items: center; gap: 0.5rem; cursor: pointer; }
		.user-avatar-sm { width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, var(--gold), var(--gold-dark)); display: flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: 600; color: #1a1a1a; }
		.user-name { color: var(--text-gray); font-size: 0.8rem; }
		.dropdown-icon { width: 12px; height: 12px; stroke: var(--text-gray); fill: none; }

		/* ===================== BANNER ===================== */
		.profile-banner {
			position: relative;
			height: 260px;
			overflow: hidden;
			background: linear-gradient(135deg, #1a1a1a 0%, #0a0a0a 50%, #1a1510 100%);
		}
		.banner-pattern {
			position: absolute; inset: 0;
			background-image: 
				radial-gradient(circle at 20% 50%, rgba(201,169,98,0.08) 0%, transparent 50%),
				radial-gradient(circle at 80% 30%, rgba(201,169,98,0.05) 0%, transparent 40%),
				radial-gradient(circle at 50% 80%, rgba(61,35,20,0.15) 0%, transparent 50%);
		}
		.banner-lines {
			position: absolute; inset: 0;
			background: repeating-linear-gradient(90deg, transparent, transparent 60px, rgba(201,169,98,0.03) 60px, rgba(201,169,98,0.03) 61px);
		}
		.banner-badge {
			position: absolute; top: 1.5rem; right: 2rem;
			background: linear-gradient(135deg, var(--gold), var(--gold-dark));
			color: #1a1a1a; padding: 0.5rem 1.25rem; border-radius: 30px;
			font-size: 0.8rem; font-weight: 600; display: flex; align-items: center; gap: 0.5rem;
		}
		.banner-badge svg { width: 16px; height: 16px; fill: #1a1a1a; stroke: none; }

		/* ===================== PROFILE CARD ===================== */
		.profile-section {
			max-width: 1200px;
			margin: -80px auto 0;
			padding: 0 2rem 3rem;
			position: relative;
			z-index: 5;
		}
		.profile-top {
			display: flex;
			gap: 2rem;
			align-items: flex-end;
			margin-bottom: 2rem;
		}
		.profile-avatar-wrap {
			flex-shrink: 0;
		}
		.profile-avatar {
			width: 150px; height: 150px;
			border-radius: 50%;
			border: 4px solid var(--gold);
			overflow: hidden;
			box-shadow: 0 8px 32px rgba(0,0,0,0.5), 0 0 20px rgba(201,169,98,0.2);
		}
		.profile-avatar img { width: 100%; height: 100%; object-fit: cover; }
		.profile-info { flex: 1; padding-bottom: 0.5rem; }
		.profile-name {
			font-family: 'Playfair Display', serif;
			font-size: 2rem; font-weight: 700; color: var(--text-white); margin-bottom: 0.25rem;
		}
		.profile-role {
			display: inline-flex; align-items: center; gap: 0.4rem;
			background: rgba(201,169,98,0.15); border: 1px solid rgba(201,169,98,0.3);
			color: var(--gold); padding: 0.3rem 0.8rem; border-radius: 20px;
			font-size: 0.75rem; font-weight: 600; margin-bottom: 0.5rem;
		}
		.profile-role svg { width: 14px; height: 14px; }
		.profile-location { color: var(--text-gray); font-size: 0.85rem; display: flex; align-items: center; gap: 0.4rem; }
		.profile-location svg { width: 14px; height: 14px; stroke: var(--gold); fill: none; }
		.profile-actions {
			display: flex; flex-direction: column; gap: 0.6rem; flex-shrink: 0; padding-bottom: 0.5rem;
		}
		.btn-edit {
			display: flex; align-items: center; gap: 0.5rem;
			background: linear-gradient(135deg, var(--gold), var(--gold-dark));
			color: #1a1a1a; border: none; padding: 0.6rem 1.5rem; border-radius: 8px;
			font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: all 0.3s;
		}
		.btn-edit:hover { transform: translateY(-1px); box-shadow: 0 4px 15px rgba(201,169,98,0.4); }
		.btn-edit svg { width: 14px; height: 14px; }
		.btn-support {
			display: flex; align-items: center; gap: 0.5rem;
			background: transparent; color: var(--gold);
			border: 1px solid rgba(201,169,98,0.4); padding: 0.6rem 1.5rem; border-radius: 8px;
			font-size: 0.8rem; font-weight: 500; cursor: pointer; transition: all 0.3s;
		}
		.btn-support:hover { background: rgba(201,169,98,0.1); }
		.btn-support svg { width: 14px; height: 14px; stroke: var(--gold); fill: none; }
		.btn-logout {
			display: flex; align-items: center; gap: 0.5rem;
			background: transparent; color: #e74c3c;
			border: 1px solid rgba(231,76,60,0.3); padding: 0.6rem 1.5rem; border-radius: 8px;
			font-size: 0.8rem; font-weight: 500; cursor: pointer; transition: all 0.3s;
		}
		.btn-logout:hover { background: rgba(231,76,60,0.1); border-color: rgba(231,76,60,0.5); }
		.btn-logout svg { width: 14px; height: 14px; stroke: #e74c3c; fill: none; }

		/* ===================== STATS ===================== */
		.stats-grid {
			display: grid;
			grid-template-columns: repeat(4, 1fr);
			gap: 1rem;
			margin-bottom: 2rem;
		}
		.stat-card {
			background: var(--dark-card);
			border: 1px solid rgba(201,169,98,0.15);
			border-radius: 12px;
			padding: 1.25rem;
			text-align: center;
			transition: all 0.3s;
		}
		.stat-card:hover { border-color: rgba(201,169,98,0.4); transform: translateY(-2px); }
		.stat-number {
			font-family: 'Playfair Display', serif;
			font-size: 1.8rem; font-weight: 700; color: var(--gold); margin-bottom: 0.25rem;
		}
		.stat-label { color: var(--text-gray); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; }
		.stat-icon { margin-bottom: 0.5rem; }
		.stat-icon svg { width: 22px; height: 22px; stroke: var(--gold); fill: none; }

		/* Stars */
		.stars-display { display: flex; justify-content: center; gap: 2px; margin-bottom: 0.25rem; }
		.stars-display svg { width: 18px; height: 18px; }
		.star-filled { fill: var(--gold); stroke: var(--gold); }
		.star-empty { fill: none; stroke: var(--text-gray); }

		/* ===================== TABS (CSS-only radio hack) ===================== */
		.tab-radio { display: none; }
		.tabs-container {
			display: flex; gap: 0;
			border-bottom: 2px solid var(--dark-lighter);
			margin-bottom: 2rem;
		}
		.tab-btn {
			flex: 1;
			padding: 1rem 1.5rem;
			background: transparent;
			border: none;
			color: var(--text-gray);
			font-size: 0.85rem;
			font-weight: 500;
			cursor: pointer;
			transition: all 0.3s;
			position: relative;
			display: flex; align-items: center; justify-content: center; gap: 0.5rem;
			text-decoration: none;
		}
		.tab-btn:hover { color: var(--text-white); background: rgba(201,169,98,0.05); }
		.tab-btn svg { width: 16px; height: 16px; stroke: currentColor; fill: none; }
		.tab-content { display: none; }

		/* CSS-only tab switching via radio inputs */
		#radio-info:checked ~ .tabs-container label[for="radio-info"],
		#radio-valoraciones:checked ~ .tabs-container label[for="radio-valoraciones"],
		#radio-actividad:checked ~ .tabs-container label[for="radio-actividad"] {
			color: var(--gold);
		}
		#radio-info:checked ~ .tabs-container label[for="radio-info"]::after,
		#radio-valoraciones:checked ~ .tabs-container label[for="radio-valoraciones"]::after,
		#radio-actividad:checked ~ .tabs-container label[for="radio-actividad"]::after {
			content: ''; position: absolute; bottom: -2px; left: 0; right: 0;
			height: 2px; background: var(--gold);
		}
		#radio-info:checked ~ #tab-info,
		#radio-valoraciones:checked ~ #tab-valoraciones,
		#radio-actividad:checked ~ #tab-actividad {
			display: block;
		}

		/* ===================== INFO CARDS ===================== */
		.info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
		.info-card {
			background: var(--dark-card);
			border: 1px solid rgba(201,169,98,0.12);
			border-radius: 14px;
			padding: 1.5rem;
		}
		.info-card-title {
			font-family: 'Playfair Display', serif;
			color: var(--gold); font-size: 1rem; font-weight: 600;
			margin-bottom: 1.25rem; padding-bottom: 0.75rem;
			border-bottom: 1px solid rgba(201,169,98,0.15);
			display: flex; align-items: center; gap: 0.5rem;
		}
		.info-card-title svg { width: 18px; height: 18px; stroke: var(--gold); fill: none; }
		.info-row {
			display: flex; justify-content: space-between; align-items: center;
			padding: 0.6rem 0;
			border-bottom: 1px solid rgba(255,255,255,0.04);
		}
		.info-row:last-child { border-bottom: none; }
		.info-label { color: var(--text-gray); font-size: 0.8rem; }
		.info-value { color: var(--text-white); font-size: 0.85rem; font-weight: 500; text-align: right; }
		.info-badge {
			display: inline-flex; align-items: center; gap: 0.3rem;
			padding: 0.2rem 0.6rem; border-radius: 12px; font-size: 0.75rem; font-weight: 600;
		}
		.badge-active { background: rgba(45,122,95,0.2); color: #2ecc71; border: 1px solid rgba(45,122,95,0.3); }
		.badge-gold { background: rgba(201,169,98,0.15); color: var(--gold); border: 1px solid rgba(201,169,98,0.3); }

		/* ===================== VALORACIONES ===================== */
		.valoraciones-list { display: flex; flex-direction: column; gap: 1rem; }
		.valoracion-card {
			background: var(--dark-card);
			border: 1px solid rgba(201,169,98,0.12);
			border-radius: 12px; padding: 1.25rem;
			transition: all 0.3s;
		}
		.valoracion-card:hover { border-color: rgba(201,169,98,0.3); }
		.valoracion-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 0.75rem; }
		.valoracion-avatar {
			width: 40px; height: 40px; border-radius: 50%;
			background: linear-gradient(135deg, var(--gold), var(--gold-dark));
			display: flex; align-items: center; justify-content: center;
			font-size: 0.75rem; font-weight: 600; color: #1a1a1a; flex-shrink: 0;
		}
		.valoracion-meta { flex: 1; }
		.valoracion-cliente { color: var(--text-white); font-size: 0.85rem; font-weight: 500; }
		.valoracion-ruta { color: var(--text-gray); font-size: 0.75rem; }
		.valoracion-fecha { color: var(--text-gray); font-size: 0.7rem; }
		.valoracion-stars { display: flex; gap: 2px; }
		.valoracion-stars svg { width: 14px; height: 14px; }
		.valoracion-text { color: var(--text-gray); font-size: 0.8rem; line-height: 1.5; font-style: italic; padding-left: 3.25rem; }
		.valoracion-tipo {
			display: inline-block; margin-left: 3.25rem; margin-top: 0.5rem;
			padding: 0.15rem 0.5rem; border-radius: 8px; font-size: 0.65rem; font-weight: 600;
			text-transform: uppercase; letter-spacing: 0.5px;
		}
		.tipo-chofer { background: rgba(201,169,98,0.15); color: var(--gold); }
		.tipo-servicio { background: rgba(45,122,95,0.2); color: #2ecc71; }

		/* ===================== ACTIVIDAD ===================== */
		.actividad-list { display: flex; flex-direction: column; gap: 1rem; }
		.actividad-card {
			display: flex; align-items: center; gap: 1rem;
			background: var(--dark-card);
			border: 1px solid rgba(201,169,98,0.1);
			border-radius: 12px; padding: 1rem 1.25rem;
			transition: all 0.3s;
		}
		.actividad-card:hover { border-color: rgba(201,169,98,0.25); }
		.actividad-icon-wrap {
			width: 42px; height: 42px; border-radius: 10px;
			display: flex; align-items: center; justify-content: center; flex-shrink: 0;
		}
		.actividad-icon-wrap svg { width: 20px; height: 20px; fill: none; }
		.icon-completado { background: rgba(45,122,95,0.2); }
		.icon-completado svg { stroke: #2ecc71; }
		.icon-cancelado { background: rgba(231,76,60,0.15); }
		.icon-cancelado svg { stroke: #e74c3c; }
		.icon-valoracion { background: rgba(201,169,98,0.15); }
		.icon-valoracion svg { stroke: var(--gold); }
		.actividad-info { flex: 1; }
		.actividad-titulo { color: var(--text-white); font-size: 0.85rem; font-weight: 500; margin-bottom: 0.15rem; }
		.actividad-detalle { color: var(--text-gray); font-size: 0.75rem; }
		.actividad-fecha { color: var(--text-gray); font-size: 0.7rem; white-space: nowrap; }
		.actividad-monto { color: var(--gold); font-weight: 600; font-size: 0.85rem; white-space: nowrap; }

		/* ===================== BUSES ===================== */
		.buses-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
		.bus-card {
			background: var(--dark-card);
			border: 1px solid rgba(201,169,98,0.12);
			border-radius: 12px; padding: 1.25rem;
			display: flex; align-items: center; gap: 1rem;
		}
		.bus-img {
			width: 80px; height: 55px; border-radius: 8px; object-fit: cover;
			border: 1px solid rgba(201,169,98,0.2);
		}
		.bus-info { flex: 1; }
		.bus-nombre { color: var(--text-white); font-size: 0.85rem; font-weight: 600; margin-bottom: 0.2rem; }
		.bus-placa { color: var(--gold); font-size: 0.75rem; font-weight: 500; }
		.bus-cap { color: var(--text-gray); font-size: 0.7rem; }

		/* ===================== MODAL (:target CSS-only) ===================== */
		.modal-overlay {
			display: none; position: fixed; inset: 0;
			background: rgba(0,0,0,0.7); z-index: 200;
			align-items: center; justify-content: center;
			backdrop-filter: blur(5px);
		}
		.modal-overlay:target { display: flex; }
		.modal-backdrop {
			position: absolute; inset: 0; z-index: 0;
		}
		.modal-box {
			background: var(--dark-card);
			border: 1px solid rgba(201,169,98,0.3);
			border-radius: 16px; padding: 2rem; max-width: 480px; width: 90%;
			position: relative; z-index: 1;
		}
		.modal-title {
			font-family: 'Playfair Display', serif;
			color: var(--gold); font-size: 1.2rem; margin-bottom: 1rem;
			display: flex; align-items: center; gap: 0.5rem;
		}
		.modal-title svg { width: 20px; height: 20px; stroke: var(--gold); fill: none; }
		.modal-text { color: var(--text-gray); font-size: 0.85rem; line-height: 1.6; margin-bottom: 1.5rem; }
		.modal-contact { display: flex; flex-direction: column; gap: 0.75rem; margin-bottom: 1.5rem; }
		.modal-contact-item {
			display: flex; align-items: center; gap: 0.75rem;
			color: var(--text-white); font-size: 0.85rem;
		}
		.modal-contact-item svg { width: 18px; height: 18px; stroke: var(--gold); fill: none; flex-shrink: 0; }
		.modal-btns { display: flex; gap: 0.75rem; justify-content: flex-end; }
		.modal-btn-close {
			padding: 0.6rem 1.5rem; border-radius: 8px;
			background: transparent; border: 1px solid rgba(201,169,98,0.3);
			color: var(--text-gray); font-size: 0.8rem; cursor: pointer; transition: all 0.3s;
			text-decoration: none; display: inline-block; text-align: center;
		}
		.modal-btn-close:hover { border-color: var(--gold); color: var(--gold); }
		.modal-btn-confirm {
			padding: 0.6rem 1.5rem; border-radius: 8px;
			background: #e74c3c; border: none;
			color: white; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: all 0.3s;
			text-decoration: none; display: inline-block; text-align: center;
		}
		.modal-btn-confirm:hover { background: #c0392b; }
		.modal-btn-whatsapp {
			padding: 0.6rem 1.5rem; border-radius: 8px;
			background: #25d366; border: none;
			color: white; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: all 0.3s;
			display: inline-flex; align-items: center; gap: 0.4rem; text-decoration: none;
		}

		/* ===================== RESPONSIVE ===================== */
		@media (max-width: 768px) {
			.header { padding: 0.75rem 1rem; }
			.nav-menu { gap: 1rem; margin-left: 1.5rem; margin-right: 1.5rem; }
			.nav-item span { display: none; }
			.profile-banner { height: 180px; }
			.profile-section { margin-top: -60px; padding: 0 1rem 2rem; }
			.profile-top { flex-direction: column; align-items: center; text-align: center; }
			.profile-avatar { width: 110px; height: 110px; }
			.profile-name { font-size: 1.5rem; }
			.profile-actions { flex-direction: row; flex-wrap: wrap; justify-content: center; }
			.stats-grid { grid-template-columns: repeat(2, 1fr); }
			.info-grid { grid-template-columns: 1fr; }
			.buses-grid { grid-template-columns: 1fr; }
		}
	</style>
</head>
<body>

	<!-- HEADER -->
	<header class="header">
		<a href="/" style="text-decoration:none" class="logo">
			<span class="logo-x">X</span><span class="logo-text">SERVICIOS</span>
		</a>
		<nav class="nav-menu">
			<a href="/home-public" class="nav-item">
				<svg class="nav-icon" viewBox="0 0 24 24" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
				<span>Inicio</span>
			</a>
			<a href="/ver-flota" class="nav-item">
				<svg class="nav-icon" viewBox="0 0 24 24" stroke-width="2"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9L18 10l-1.9-4.6c-.3-.7-1-1.4-1.8-1.4H9.7c-.8 0-1.5.5-1.8 1.2L6 10l-2.5 1.1C2.7 11.3 2 12.1 2 13v3c0 .6.4 1 1 1h2"/><circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/></svg>
				<span>Ver flota</span>
			</a>
			<a href="#" class="nav-item">
				<svg class="nav-icon" viewBox="0 0 24 24" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
				<span>Servicios</span>
			</a>
			<a href="#" class="nav-item">
				<svg class="nav-icon" viewBox="0 0 24 24" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
				<span>Nosotros</span>
			</a>
		</nav>
		<div class="user-actions">
			<div class="lang-selector">
				<svg class="lang-icon" viewBox="0 0 24 24" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
				<span class="lang-text">ES</span><span class="lang-divider">|</span><span class="lang-text">EN</span>
			</div>
			<div class="notification-icon">
				<svg viewBox="0 0 24 24" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
			</div>
			<a href="/perfil-chofer" style="text-decoration:none" class="user-profile">
				<div class="user-avatar-sm">RM</div>
				<span class="user-name">Ricardo M.</span>
				<svg class="dropdown-icon" viewBox="0 0 24 24" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
			</a>
		</div>
	</header>

	<!-- BANNER -->
	<div class="profile-banner">
		<div class="banner-pattern"></div>
		<div class="banner-lines"></div>
		<div class="banner-badge">
			<svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
			Chofer Verificado
		</div>
	</div>

	<!-- PROFILE SECTION -->
	<div class="profile-section">
		<div class="profile-top">
			<div class="profile-avatar-wrap">
				<div class="profile-avatar">
					<img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=300&h=300&fit=crop&crop=face" alt="Ricardo Morales">
				</div>
			</div>
			<div class="profile-info">
				<h1 class="profile-name">Ricardo A. Morales D.</h1>
				<div class="profile-role">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
					CHOFER PREMIUM
				</div>
				<div class="profile-location">
					<svg viewBox="0 0 24 24" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
					David, Chiriqui, Panama
				</div>
			</div>
			<div class="profile-actions">
				<a href="#modal-edit" class="btn-edit">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
					Editar Perfil
				</a>
				<a href="#modal-support" class="btn-support">
					<svg viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
					Ayuda y Soporte
				</a>
				<a href="#modal-logout" class="btn-logout">
					<svg viewBox="0 0 24 24" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
					Cerrar Sesion
				</a>
			</div>
		</div>

		<!-- STATS -->
		<div class="stats-grid">
			<div class="stat-card">
				<div class="stat-icon"><svg viewBox="0 0 24 24" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
				<div class="stat-number">247</div>
				<div class="stat-label">Viajes Completados</div>
			</div>
			<div class="stat-card">
				<div class="stat-icon"><svg viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
				<div class="stat-number">3</div>
				<div class="stat-label">Anos de Experiencia</div>
			</div>
			<div class="stat-card">
				<div class="stars-display">
					<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
					<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
					<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
					<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
					<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
				</div>
				<div class="stat-number">4.9</div>
				<div class="stat-label">Valoracion Promedio</div>
			</div>
			<div class="stat-card">
				<div class="stat-icon"><svg viewBox="0 0 24 24" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
				<div class="stat-number">189</div>
				<div class="stat-label">Clientes Atendidos</div>
			</div>
		</div>

		<!-- TABS (CSS-only con radio inputs) -->
		<input type="radio" name="tab" id="radio-info" class="tab-radio" checked>
		<input type="radio" name="tab" id="radio-valoraciones" class="tab-radio">
		<input type="radio" name="tab" id="radio-actividad" class="tab-radio">

		<div class="tabs-container">
			<label for="radio-info" class="tab-btn">
				<svg viewBox="0 0 24 24" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
				Informacion Personal
			</label>
			<label for="radio-valoraciones" class="tab-btn">
				<svg viewBox="0 0 24 24" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
				Valoraciones Recibidas
			</label>
			<label for="radio-actividad" class="tab-btn">
				<svg viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
				Actividad Reciente
			</label>
		</div>

		<!-- TAB: INFO PERSONAL -->
		<div id="tab-info" class="tab-content">
			<div class="info-grid">
				<div class="info-card">
					<div class="info-card-title">
						<svg viewBox="0 0 24 24" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
						Datos Personales
					</div>
					<div class="info-row"><span class="info-label">Nombre completo</span><span class="info-value">Ricardo Antonio Morales Delgado</span></div>
					<div class="info-row"><span class="info-label">Cedula</span><span class="info-value">4-789-2341</span></div>
					<div class="info-row"><span class="info-label">Fecha de nacimiento</span><span class="info-value">15 de Marzo, 1988</span></div>
					<div class="info-row"><span class="info-label">Tipo de sangre</span><span class="info-value">O+</span></div>
					<div class="info-row">
						<span class="info-label">Estado</span>
						<span class="info-badge badge-active">Activo</span>
					</div>
				</div>

				<div class="info-card">
					<div class="info-card-title">
						<svg viewBox="0 0 24 24" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
						Contacto
					</div>
					<div class="info-row"><span class="info-label">Telefono</span><span class="info-value">+507 6712-8945</span></div>
					<div class="info-row"><span class="info-label">Tel. alternativo</span><span class="info-value">+507 775-3412</span></div>
					<div class="info-row"><span class="info-label">Correo electronico</span><span class="info-value">r.morales@gmail.com</span></div>
					<div class="info-row"><span class="info-label">Direccion</span><span class="info-value">Av. 2da Este, David, Chiriqui</span></div>
					<div class="info-row"><span class="info-label">Miembro desde</span><span class="info-value">Enero 2023</span></div>
				</div>

				<div class="info-card">
					<div class="info-card-title">
						<svg viewBox="0 0 24 24" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 10h20"/><path d="M7 15h.01"/><path d="M11 15h2"/></svg>
						Licencia de Conducir
					</div>
					<div class="info-row"><span class="info-label">Tipo de licencia</span><span class="info-value">Tipo B (Comercial)</span></div>
					<div class="info-row"><span class="info-label">Numero</span><span class="info-value">LIC-CHI-2021-4789</span></div>
					<div class="info-row"><span class="info-label">Emision</span><span class="info-value">10 de Enero, 2021</span></div>
					<div class="info-row"><span class="info-label">Vencimiento</span><span class="info-value">10 de Enero, 2027</span></div>
					<div class="info-row">
						<span class="info-label">Estado</span>
						<span class="info-badge badge-active">Vigente</span>
					</div>
				</div>

				<div class="info-card">
					<div class="info-card-title">
						<svg viewBox="0 0 24 24" stroke-width="2"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9L18 10l-1.9-4.6c-.3-.7-1-1.4-1.8-1.4H9.7c-.8 0-1.5.5-1.8 1.2L6 10l-2.5 1.1C2.7 11.3 2 12.1 2 13v3c0 .6.4 1 1 1h2"/><circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/></svg>
						Buses Asignados
					</div>
					<div class="buses-grid">
						<div class="bus-card">
							<img class="bus-img" src="https://images.unsplash.com/photo-1570125909232-eb263c188f7e?w=200&h=140&fit=crop" alt="Coaster Premium">
							<div class="bus-info">
								<div class="bus-nombre">Coaster Premium</div>
								<div class="bus-placa">CH-4521</div>
								<div class="bus-cap">30 pasajeros</div>
							</div>
						</div>
						<div class="bus-card">
							<img class="bus-img" src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=200&h=140&fit=crop" alt="Coaster Ejecutivo">
							<div class="bus-info">
								<div class="bus-nombre">Coaster Ejecutivo</div>
								<div class="bus-placa">PA-8877</div>
								<div class="bus-cap">25 pasajeros</div>
							</div>
						</div>
					</div>
				</div>

				<div class="info-card" style="grid-column: 1 / -1;">
					<div class="info-card-title">
						<svg viewBox="0 0 24 24" stroke-width="2"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
						Contacto de Emergencia
					</div>
					<div style="display:grid;grid-template-columns:1fr 1fr;gap:0 3rem;">
						<div class="info-row"><span class="info-label">Nombre</span><span class="info-value">Carmen Delgado de Morales</span></div>
						<div class="info-row"><span class="info-label">Parentesco</span><span class="info-value">Madre</span></div>
						<div class="info-row"><span class="info-label">Telefono</span><span class="info-value">+507 6698-5521</span></div>
						<div class="info-row"><span class="info-label">Direccion</span><span class="info-value">Barrio Bolivar, David</span></div>
					</div>
				</div>
			</div>
		</div>

		<!-- TAB: VALORACIONES -->
		<div id="tab-valoraciones" class="tab-content">
			<div class="valoraciones-list">

				<div class="valoracion-card">
					<div class="valoracion-header">
						<div class="valoracion-avatar">MG</div>
						<div class="valoracion-meta">
							<div class="valoracion-cliente">Maria Gonzalez</div>
							<div class="valoracion-ruta">David &rarr; Bocas del Toro</div>
						</div>
						<div style="text-align:right">
							<div class="valoracion-stars">
								<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
								<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
								<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
								<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
								<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
							</div>
							<div class="valoracion-fecha">5 Feb 2026</div>
						</div>
					</div>
					<div class="valoracion-text">"Ricardo es un excelente chofer, muy puntual y atento. El viaje fue muy comodo y seguro. Lo recomiendo totalmente."</div>
					<span class="valoracion-tipo tipo-chofer">Chofer</span>
				</div>

				<div class="valoracion-card">
					<div class="valoracion-header">
						<div class="valoracion-avatar">CP</div>
						<div class="valoracion-meta">
							<div class="valoracion-cliente">Carlos Perez</div>
							<div class="valoracion-ruta">Ciudad de Panama &rarr; San Blas</div>
						</div>
						<div style="text-align:right">
							<div class="valoracion-stars">
								<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
								<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
								<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
								<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
								<svg viewBox="0 0 24 24" class="star-empty"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
							</div>
							<div class="valoracion-fecha">28 Ene 2026</div>
						</div>
					</div>
					<div class="valoracion-text">"Buen viaje, el chofer conoce bien las rutas. Solo sugeriria mejorar el aire acondicionado en el trayecto largo."</div>
					<span class="valoracion-tipo tipo-servicio">Servicio</span>
				</div>

				<div class="valoracion-card">
					<div class="valoracion-header">
						<div class="valoracion-avatar">AR</div>
						<div class="valoracion-meta">
							<div class="valoracion-cliente">Ana Rodriguez</div>
							<div class="valoracion-ruta">Boquete &rarr; Los Cangilones</div>
						</div>
						<div style="text-align:right">
							<div class="valoracion-stars">
								<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
								<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
								<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
								<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
								<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
							</div>
							<div class="valoracion-fecha">20 Ene 2026</div>
						</div>
					</div>
					<div class="valoracion-text">"Increible experiencia! Ricardo fue muy amable, nos explico sobre los lugares turisticos durante el camino. Un verdadero profesional."</div>
					<span class="valoracion-tipo tipo-chofer">Chofer</span>
				</div>

				<div class="valoracion-card">
					<div class="valoracion-header">
						<div class="valoracion-avatar">LF</div>
						<div class="valoracion-meta">
							<div class="valoracion-cliente">Laura Fernandez</div>
							<div class="valoracion-ruta">David &rarr; Playa Las Lajas</div>
						</div>
						<div style="text-align:right">
							<div class="valoracion-stars">
								<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
								<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
								<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
								<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
								<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
							</div>
							<div class="valoracion-fecha">15 Ene 2026</div>
						</div>
					</div>
					<div class="valoracion-text">"Todo perfecto, la playa estaba hermosa y el transporte impecable. Gracias Ricardo!"</div>
					<span class="valoracion-tipo tipo-chofer">Chofer</span>
				</div>

			</div>
		</div>

		<!-- TAB: ACTIVIDAD -->
		<div id="tab-actividad" class="tab-content">
			<div class="actividad-list">
				<div class="actividad-card">
					<div class="actividad-icon-wrap icon-completado"><svg viewBox="0 0 24 24" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div>
					<div class="actividad-info">
						<div class="actividad-titulo">Viaje completado: David &rarr; Bocas del Toro</div>
						<div class="actividad-detalle">Cliente: Maria Gonzalez &bull; Coaster Premium (CH-4521)</div>
					</div>
					<div style="text-align:right">
						<div class="actividad-monto">B/. 85.00</div>
						<div class="actividad-fecha">5 Feb 2026</div>
					</div>
				</div>
				<div class="actividad-card">
					<div class="actividad-icon-wrap icon-valoracion"><svg viewBox="0 0 24 24" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg></div>
					<div class="actividad-info">
						<div class="actividad-titulo">Nueva valoracion recibida (5 estrellas)</div>
						<div class="actividad-detalle">De: Maria Gonzalez &bull; Viaje a Bocas del Toro</div>
					</div>
					<div style="text-align:right">
						<div class="actividad-fecha">5 Feb 2026</div>
					</div>
				</div>
				<div class="actividad-card">
					<div class="actividad-icon-wrap icon-completado"><svg viewBox="0 0 24 24" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div>
					<div class="actividad-info">
						<div class="actividad-titulo">Viaje completado: Panama City &rarr; San Blas</div>
						<div class="actividad-detalle">Cliente: Carlos Perez &bull; Coaster Ejecutivo (PA-8877)</div>
					</div>
					<div style="text-align:right">
						<div class="actividad-monto">B/. 120.00</div>
						<div class="actividad-fecha">28 Ene 2026</div>
					</div>
				</div>
				<div class="actividad-card">
					<div class="actividad-icon-wrap icon-cancelado"><svg viewBox="0 0 24 24" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></div>
					<div class="actividad-info">
						<div class="actividad-titulo">Solicitud rechazada: Boquete &rarr; Volcan Baru</div>
						<div class="actividad-detalle">Cliente: Jose Torres &bull; Horario no disponible</div>
					</div>
					<div style="text-align:right">
						<div class="actividad-fecha">22 Ene 2026</div>
					</div>
				</div>
				<div class="actividad-card">
					<div class="actividad-icon-wrap icon-completado"><svg viewBox="0 0 24 24" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div>
					<div class="actividad-info">
						<div class="actividad-titulo">Viaje completado: Boquete &rarr; Los Cangilones</div>
						<div class="actividad-detalle">Cliente: Ana Rodriguez &bull; Coaster Premium (CH-4521)</div>
					</div>
					<div style="text-align:right">
						<div class="actividad-monto">B/. 45.00</div>
						<div class="actividad-fecha">20 Ene 2026</div>
					</div>
				</div>
				<div class="actividad-card">
					<div class="actividad-icon-wrap icon-completado"><svg viewBox="0 0 24 24" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div>
					<div class="actividad-info">
						<div class="actividad-titulo">Viaje completado: David &rarr; Playa Las Lajas</div>
						<div class="actividad-detalle">Cliente: Laura Fernandez &bull; Coaster Premium (CH-4521)</div>
					</div>
					<div style="text-align:right">
						<div class="actividad-monto">B/. 55.00</div>
						<div class="actividad-fecha">15 Ene 2026</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- MODAL: EDITAR PERFIL -->
	<div id="modal-edit" class="modal-overlay">
		<a href="#" class="modal-backdrop"></a>
		<div class="modal-box">
			<div class="modal-title">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
				Editar Perfil
			</div>
			<div class="modal-text">La funcion de edicion de perfil estara disponible proximamente. Estamos trabajando para habi... (truncated)

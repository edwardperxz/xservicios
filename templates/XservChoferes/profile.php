<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservChofere $chofer
 * @var array $estadisticas
 * @var \Cake\Collection\CollectionInterface $valoraciones
 * @var \Cake\Collection\CollectionInterface $actividadReciente
 */

use Cake\I18n\FrozenTime;

define('CSS_VARS', '
:root {
    --dark-deep: #0d0d0d;
    --dark-card: #1a1a1a;
    --dark-lighter: #2a2a2a;
    --gold: #c9a962;
    --gold-dark: #8b7a3d;
    --text-white: #ffffff;
    --text-gray: #a0a0a0;
}
');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Xservicios - Perfil Chofer</title>
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<style>
		<?= CSS_VARS ?>

		* { 
			margin: 0; 
			padding: 0; 
			box-sizing: border-box;
			animation: none !important;
			transition: none !important;
		}

		body {
			font-family: 'Inter', sans-serif;
			background-color: var(--dark-deep);
			color: var(--text-white);
			min-height: 100vh;
			animation: none !important;
			transition: none !important;
		}

		body * {
			animation: none !important;
			transition: none !important;
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
		.logo-x { font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 700; color: var(--gold); }
		.logo-text { font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 600; color: var(--text-white); letter-spacing: 0.5px; }
		.nav-menu { display: flex; align-items: center; gap: 2rem; margin-left: 4rem; margin-right: 4rem; }
		.nav-item { display: flex; align-items: center; gap: 0.4rem; color: var(--text-gray); text-decoration: none; font-size: 0.85rem; white-space: nowrap; }
		.nav-item.active { color: var(--gold); }
		.nav-icon { width: 16px; height: 16px; stroke: currentColor; fill: none; flex-shrink: 0; }
		.user-actions { display: flex; align-items: center; gap: 1.25rem; margin-left: auto; }
		.lang-selector { display: flex; align-items: center; gap: 0.4rem; color: var(--text-gray); font-size: 0.8rem; }
		.lang-text { color: var(--text-gray); cursor: pointer; font-size: 0.8rem; }

		.lang-divider { color: rgba(160,160,160,0.3); font-size: 0.8rem; }
		.user-profile { display: flex; align-items: center; gap: 0.5rem; cursor: pointer; }
		.user-avatar-sm { width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, var(--gold), var(--gold-dark)); display: flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: 600; color: #1a1a1a; }
		.user-name { color: var(--text-gray); font-size: 0.8rem; }

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
			font-size: 0.8rem; font-weight: 600; cursor: pointer;
		}
		.btn-edit svg { width: 14px; height: 14px; }

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
		}

		.stat-number {
			font-family: 'Playfair Display', serif;
			font-size: 1.8rem; font-weight: 700; color: var(--gold); margin-bottom: 0.25rem;
		}
		.stat-label { color: var(--text-gray); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; }
		.stat-icon { margin-bottom: 0.5rem; }
		.stat-icon svg { width: 22px; height: 22px; stroke: var(--gold); fill: none; }

		/* ===================== TABS ===================== */
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
			position: relative;
			display: flex; align-items: center; justify-content: center; gap: 0.5rem;
			text-decoration: none;
		}

		.tab-btn svg { width: 16px; height: 16px; stroke: currentColor; fill: none; }
		.tab-content { display: none; }

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

		/* ===================== VALORACIONES ===================== */
		.valoraciones-list { display: flex; flex-direction: column; gap: 1rem; }
		.valoracion-card {
			background: var(--dark-card);
			border: 1px solid rgba(201,169,98,0.12);
			border-radius: 12px; padding: 1.25rem;
		}

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
		.star-filled { fill: var(--gold); stroke: var(--gold); }
		.star-empty { fill: none; stroke: var(--text-gray); }
		.valoracion-text { color: var(--text-gray); font-size: 0.8rem; line-height: 1.5; font-style: italic; padding-left: 3.25rem; }

		/* ===================== ACTIVIDAD ===================== */
		.actividad-list { display: flex; flex-direction: column; gap: 1rem; }
		.actividad-card {
			display: flex; align-items: center; gap: 1rem;
			background: var(--dark-card);
			border: 1px solid rgba(201,169,98,0.1);
			border-radius: 12px; padding: 1rem 1.25rem;
		}

		.actividad-icon-wrap {
			width: 42px; height: 42px; border-radius: 10px;
			display: flex; align-items: center; justify-content: center; flex-shrink: 0;
		}
		.actividad-icon-wrap svg { width: 20px; height: 20px; fill: none; }
		.icon-completado { background: rgba(45,122,95,0.2); }
		.icon-completado svg { stroke: #2ecc71; }
		.actividad-info { flex: 1; }
		.actividad-titulo { color: var(--text-white); font-size: 0.85rem; font-weight: 500; margin-bottom: 0.15rem; }
		.actividad-detalle { color: var(--text-gray); font-size: 0.75rem; }
		.actividad-fecha { color: var(--text-gray); font-size: 0.7rem; white-space: nowrap; }

		/* ===================== RESPONSIVE ===================== */
		*::before, *::after {
			animation: none !important;
			transition: none !important;
		}

		:hover, :active, :focus {
			animation: none !important;
			transition: none !important;
		}

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
		</nav>
		<div class="user-actions">
			<a href="/logout" style="text-decoration:none" class="user-profile">
				<div class="user-avatar-sm"><?= substr($chofer->usuario->nombre ?? '', 0, 2) ?></div>
				<span class="user-name"><?= h($chofer->usuario->nombre ?? 'Chofer') ?></span>
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
					<img src="<?= $chofer->usuario->foto_url ?? 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=300&h=300&fit=crop&crop=face' ?>" alt="<?= h($chofer->usuario->nombre ?? 'Chofer') ?>">
				</div>
			</div>
			<div class="profile-info">
				<h1 class="profile-name"><?= h($chofer->usuario->nombre ?? 'Sin nombre') ?></h1>
				<div class="profile-role">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
					CHOFER
				</div>
				<div class="profile-location">
					<svg viewBox="0 0 24 24" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
					Panama
				</div>
			</div>
			<div class="profile-actions">
				<a href="#" class="btn-edit">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
					Editar Perfil
				</a>
			</div>
		</div>

		<!-- STATS -->
		<div class="stats-grid">
			<div class="stat-card">
				<div class="stat-icon"><svg viewBox="0 0 24 24" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
				<div class="stat-number"><?= $estadisticas['total_viajes'] ?></div>
				<div class="stat-label">Viajes Completados</div>
			</div>
			<div class="stat-card">
				<div class="stat-icon"><svg viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
				<div class="stat-number"><?= $chofer->fecha_ingreso ? (new FrozenTime())->diff($chofer->fecha_ingreso)->y : 0 ?></div>
				<div class="stat-label">Anos de Experiencia</div>
			</div>
			<div class="stat-card">
				<div class="stat-number"><?= $estadisticas['promedio_calificacion'] ?></div>
				<div class="stat-label">Valoracion Promedio</div>
			</div>
			<div class="stat-card">
				<div class="stat-icon"><svg viewBox="0 0 24 24" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
				<div class="stat-number"><?= $estadisticas['clientes_atendidos'] ?></div>
				<div class="stat-label">Clientes Atendidos</div>
			</div>
		</div>

		<!-- TABS -->
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
				Valoraciones (<?= $estadisticas['total_valoraciones'] ?>)
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
					<div class="info-row"><span class="info-label">Nombre completo</span><span class="info-value"><?= h($chofer->usuario->nombre ?? '-') ?></span></div>
					<div class="info-row"><span class="info-label">Email</span><span class="info-value"><?= h($chofer->usuario->email ?? '-') ?></span></div>
					<div class="info-row"><span class="info-label">Tipo de sangre</span><span class="info-value"><?= h($chofer->usuario->tipo_sangre ?? 'No registrado') ?></span></div>
					<div class="info-row">
						<span class="info-label">Estado</span>
						<span class="info-badge badge-active"><?= ucfirst($chofer->estado) ?></span>
					</div>
				</div>

				<div class="info-card">
					<div class="info-card-title">
						<svg viewBox="0 0 24 24" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
						Contacto
					</div>
					<div class="info-row"><span class="info-label">Telefono</span><span class="info-value"><?= h($chofer->usuario->telefono ?? '-') ?></span></div>
					<div class="info-row"><span class="info-label">Correo electronico</span><span class="info-value"><?= h($chofer->usuario->email ?? '-') ?></span></div>
					<div class="info-row"><span class="info-label">Direccion</span><span class="info-value"><?= h($chofer->usuario->direccion ?? 'No registrada') ?></span></div>
					<div class="info-row"><span class="info-label">Miembro desde</span><span class="info-value"><?= ($chofer->fecha_ingreso ?? false) ? $chofer->fecha_ingreso->format('d/m/Y') : '-' ?></span></div>
				</div>

				<div class="info-card">
					<div class="info-card-title">
						<svg viewBox="0 0 24 24" stroke-width="2"><path d="M6 9l6-6 6 6"/><path d="M9 20h6v-6h-6z"/><path d="M3 10h18v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V10z"/></svg>
						Licencia de Conducir
					</div>
					<div class="info-row"><span class="info-label">Tipo de licencia</span><span class="info-value"><?= h($chofer->tipo_licencia ?? 'No registrada') ?></span></div>
					<div class="info-row"><span class="info-label">Estado</span><span class="info-badge badge-active">Activa</span></div>
					<div class="info-row"><span class="info-label">Disponibilidad</span><span class="info-value"><?= ucfirst(str_replace('_', ' ', $chofer->disponibilidad)) ?></span></div>
				</div>
			</div>
		</div>

		<!-- TAB: VALORACIONES -->
		<div id="tab-valoraciones" class="tab-content">
			<div class="valoraciones-list">
				<?php if ($valoraciones->count() > 0): ?>
					<?php foreach ($valoraciones as $valoracion): ?>
						<div class="valoracion-card">
							<div class="valoracion-header">
								<div class="valoracion-avatar">
									<?= substr($valoracion->reserva->cliente->usuario->nombre ?? 'X', 0, 2) ?>
								</div>
								<div class="valoracion-meta">
									<div class="valoracion-cliente"><?= h($valoracion->reserva->cliente->usuario->nombre ?? 'Cliente') ?></div>
									<div class="valoracion-fecha" data-date="<?= $valoracion->created_at ?>">
										<?= ($valoracion->created_at ?? false) ? $valoracion->created_at->timeAgoInWords() : '' ?>
									</div>
								</div>
								<div class="valoracion-stars">
									<?php for ($i = 0; $i < 5; $i++): ?>
										<?php if ($i < (int)($valoracion->calificacion ?? 0)): ?>
											<svg viewBox="0 0 24 24" class="star-filled"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
										<?php else: ?>
											<svg viewBox="0 0 24 24" class="star-empty"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/></svg>
										<?php endif; ?>
									<?php endfor; ?>
								</div>
							</div>
							<div class="valoracion-text">"<?= h($valoracion->comentario ?? '') ?>"</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div style="text-align: center; padding: 2rem; color: var(--text-gray);">
						<p>Aun no hay valoraciones recibidas</p>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<!-- TAB: ACTIVIDAD -->
		<div id="tab-actividad" class="tab-content">
			<div class="actividad-list">
				<?php if ($actividadReciente->count() > 0): ?>
					<?php foreach ($actividadReciente as $actividad): ?>
						<div class="actividad-card">
							<div class="actividad-icon-wrap icon-completado">
								<svg viewBox="0 0 24 24" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
							</div>
							<div class="actividad-info">
								<div class="actividad-titulo">Viaje asignado a <?= h($actividad->reserva->cliente->usuario->nombre ?? 'Cliente') ?></div>
								<div class="actividad-detalle"><?= h($actividad->reserva->origen ?? 'Sin origen especificado') ?> → <?= h($actividad->reserva->destino ?? 'Sin destino') ?></div>
							</div>
							<div class="actividad-fecha" data-date="<?= $actividad->created_at ?>">
								<?= ($actividad->created_at ?? false) ? $actividad->created_at->timeAgoInWords() : '' ?>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div style="text-align: center; padding: 2rem; color: var(--text-gray);">
						<p>No hay actividad reciente</p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

</body>
</html>

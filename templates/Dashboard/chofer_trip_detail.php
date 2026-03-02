<?php
$this->assign('title', 'Xservicios - Detalle de Viaje');

$reserva = $viaje->reserva ?? null;
$cliente = $reserva->cliente ?? null;
$usuarioCliente = $cliente->usuario ?? null;
$servicio = $reserva->servicio ?? null;
$vehiculo = $viaje->vehiculo ?? null;

$ejecucionActual = null;
if (!empty($viaje->xserv_ejecucion_viajes)) {
    $ejecucionActual = end($viaje->xserv_ejecucion_viajes);
}

$incidencias = $ejecucionActual && !empty($ejecucionActual->xserv_incidencias_viaje)
    ? $ejecucionActual->xserv_incidencias_viaje
    : [];

$estado = (string)($viaje->estado_asignacion ?? 'programada');
$puedeOperar = $estado === 'en_curso';
?>

<style>
  :root {
    --gold: #c9a962;
    --gold-light: #d4b978;
    --gold-dark: #a88b4a;
    --dark-bg: #0b0b0b;
    --dark-card: #161616;
    --dark-lighter: #262626;
    --text-white: #ffffff;
    --text-gray: #9da3ae;
    --green: #4ade80;
    --red: #f87171;
  }

  body {
    background: radial-gradient(circle at top, rgba(201, 169, 98, 0.12), transparent 42%), linear-gradient(180deg, rgba(11, 11, 11, 0.97), rgba(11, 11, 11, 1));
    color: var(--text-white);
    min-height: 100vh;
  }

  .detail-shell {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2.5rem 2rem 4rem;
  }

  .detail-hero {
    background: linear-gradient(135deg, rgba(201, 169, 98, 0.14), rgba(201, 169, 98, 0.03));
    border: 1px solid rgba(201, 169, 98, 0.24);
    border-radius: 18px;
    padding: 1.5rem 1.6rem;
    margin-bottom: 1.2rem;
    box-shadow: 0 20px 45px rgba(0, 0, 0, 0.35);
  }

  .detail-back {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--gold);
    text-decoration: none;
    margin-bottom: 0.85rem;
    font-weight: 600;
    font-size: 0.92rem;
    letter-spacing: 0.02em;
  }

  .detail-back:hover {
    color: var(--gold-light);
  }

  .detail-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 1.2rem;
  }

  .card {
    background: linear-gradient(160deg, rgba(28, 28, 28, 0.92), rgba(20, 20, 20, 0.95));
    border: 1px solid rgba(201, 169, 98, 0.12);
    border-radius: 14px;
    padding: 1.3rem;
    box-shadow: 0 16px 34px rgba(0, 0, 0, 0.28);
  }

  .title {
    margin: 0 0 0.35rem;
    font-size: 1.7rem;
    font-weight: 650;
    color: var(--text-white);
  }

  .subtitle {
    color: var(--text-gray);
    margin-bottom: 1.2rem;
    font-size: 0.9rem;
  }

  .title-overline {
    color: var(--gold-light);
    text-transform: uppercase;
    letter-spacing: 0.2em;
    font-size: 0.68rem;
    margin-bottom: 0.5rem;
    font-weight: 600;
  }

  .badge {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.38rem 0.82rem;
    border-radius: 999px;
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  .badge.programada { background: rgba(56, 189, 248, 0.15); color: #38bdf8; }
  .badge.en_curso { background: rgba(251, 146, 60, 0.15); color: #fb923c; }
  .badge.finalizada { background: rgba(74, 222, 128, 0.15); color: #4ade80; }
  .badge.cancelada { background: rgba(248, 113, 113, 0.15); color: #f87171; }

  .info-list {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 0.85rem;
  }

  .info-item {
    background: rgba(255, 255, 255, 0.025);
    border-radius: 10px;
    padding: 0.82rem;
    border: 1px solid rgba(255, 255, 255, 0.06);
  }

  .info-item strong {
    display: block;
    color: var(--gold);
    font-size: 0.68rem;
    margin-bottom: 0.35rem;
    letter-spacing: 0.06em;
    text-transform: uppercase;
  }

  .info-item span {
    color: var(--text-white);
    font-size: 0.93rem;
    font-weight: 500;
  }

  .actions {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
  }

  .actions textarea,
  .actions select {
    width: 100%;
    background: linear-gradient(180deg, rgba(255,255,255,0.055), rgba(255,255,255,0.03));
    border: 1px solid rgba(201,169,98,0.24);
    border-radius: 10px;
    color: var(--text-white);
    padding: 0.72rem 0.78rem;
    font-size: 0.9rem;
  }

  .actions select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    padding-right: 2.35rem;
    background-image:
      linear-gradient(45deg, transparent 50%, var(--gold) 50%),
      linear-gradient(135deg, var(--gold) 50%, transparent 50%),
      linear-gradient(180deg, rgba(255,255,255,0.055), rgba(255,255,255,0.03));
    background-position:
      calc(100% - 16px) calc(50% - 2px),
      calc(100% - 10px) calc(50% - 2px),
      0 0;
    background-size: 6px 6px, 6px 6px, 100% 100%;
    background-repeat: no-repeat;
    cursor: pointer;
    transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
  }

  .actions select:hover {
    border-color: rgba(201,169,98,0.36);
    background-color: rgba(255,255,255,0.06);
  }

  .actions select option {
    background: #171717;
    color: var(--text-white);
  }

  .actions textarea:focus,
  .actions select:focus {
    outline: none;
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(201, 169, 98, 0.14), 0 6px 14px rgba(0,0,0,0.25);
  }

  .actions label {
    color: var(--text-gray);
    font-size: 0.78rem;
    margin-bottom: 0.35rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 600;
  }

  .btn {
    border: none;
    border-radius: 10px;
    padding: 0.78rem 1rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.25s ease;
    font-size: 0.9rem;
    letter-spacing: 0.02em;
  }

  .btn-finalizar {
    background: linear-gradient(135deg, #7be89f, #4ade80);
    color: #111;
  }

  .btn-finalizar:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 18px rgba(74, 222, 128, 0.3);
  }

  .btn-incidencia {
    background: linear-gradient(135deg, #f87171, #ef4444);
    color: #fff;
  }

  .btn-incidencia:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 18px rgba(239, 68, 68, 0.32);
  }

  .muted {
    color: var(--text-gray);
    font-size: 0.85rem;
    line-height: 1.45;
  }

  .card-title {
    margin: 0 0 0.95rem;
    color: var(--text-white);
    font-size: 1.05rem;
    font-weight: 650;
  }

  .incidencia-item {
    border: 1px solid rgba(255,255,255,0.08);
    background: rgba(255,255,255,0.015);
    border-radius: 10px;
    padding: 0.72rem;
    margin-bottom: 0.55rem;
  }

  .incidencia-item strong {
    color: var(--gold-light);
  }

  .card-divider {
    border: 0;
    height: 1px;
    background: linear-gradient(to right, rgba(201,169,98,0.18), rgba(255,255,255,0.05));
    margin: 1rem 0;
  }

  @media (max-width: 900px) {
    .detail-shell {
      padding: 1.5rem 1rem 2rem;
    }

    .detail-hero {
      padding: 1.15rem;
    }

    .detail-grid { grid-template-columns: 1fr; }
    .info-list { grid-template-columns: 1fr; }
  }
</style>

<section class="detail-shell">
  <a class="detail-back" href="/chofer/viajes">← Volver a mis viajes</a>

  <div class="detail-hero">
    <div class="title-overline">Detalle del viaje</div>
    <h1 class="title">Viaje #<?= h($viaje->id) ?> · Reserva #<?= h($reserva->id ?? 'N/A') ?></h1>
    <p class="subtitle">
      <span class="badge <?= h($estado) ?>"><?= h(ucfirst(str_replace('_', ' ', $estado))) ?></span>
    </p>
  </div>

  <div class="detail-grid">
    <div class="card">
      <div class="info-list">
        <div class="info-item">
          <strong>Cliente</strong>
          <span><?= h($usuarioCliente->nombre ?? 'N/A') ?></span>
        </div>
        <div class="info-item">
          <strong>Servicio</strong>
          <span><?= h($servicio->nombre ?? 'N/A') ?></span>
        </div>
        <div class="info-item">
          <strong>Origen</strong>
          <span><?= h($reserva->punto_recogida ?? 'No especificado') ?></span>
        </div>
        <div class="info-item">
          <strong>Destino</strong>
          <span><?= h($reserva->punto_destino ?? 'No especificado') ?></span>
        </div>
        <div class="info-item">
          <strong>Inicio pactado</strong>
          <span><?= h($viaje->fecha_inicio_pactada ? $viaje->fecha_inicio_pactada->format('d/m/Y H:i') : 'N/A') ?></span>
        </div>
        <div class="info-item">
          <strong>Fin pactado</strong>
          <span><?= h($viaje->fecha_fin_pactada ? $viaje->fecha_fin_pactada->format('d/m/Y H:i') : 'N/A') ?></span>
        </div>
        <div class="info-item">
          <strong>Vehículo</strong>
          <span><?= h(($vehiculo->nombre_unidad ?? 'N/A') . ' - ' . ($vehiculo->placa ?? 'SIN PLACA')) ?></span>
        </div>
        <div class="info-item">
          <strong>Estado ejecución</strong>
          <span><?= h($ejecucionActual->estado_ejecucion ?? 'Sin ejecución') ?></span>
        </div>
      </div>

      <div class="card" style="margin-top:1rem;">
        <h3 class="card-title">Incidencias de este viaje</h3>
        <?php if (!empty($incidencias)): ?>
          <?php foreach ($incidencias as $incidencia): ?>
            <div class="incidencia-item">
              <strong><?= h($incidencia->tipo_incidencia) ?></strong>
              <div class="muted">Severidad: <?= h($incidencia->severidad ?? 'baja') ?></div>
              <div><?= h($incidencia->descripcion) ?></div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p class="muted">No hay incidencias registradas para este viaje.</p>
        <?php endif; ?>
      </div>
    </div>

    <div class="card">
      <h3 class="card-title">Acciones del viaje</h3>

      <?php if ($puedeOperar): ?>
        <?= $this->Form->create(null, ['class' => 'actions']) ?>
          <?= $this->Form->hidden('accion', ['value' => 'finalizar_viaje']) ?>
          <?= $this->Form->control('observaciones_finales', [
              'type' => 'textarea',
              'label' => 'Observaciones de cierre',
              'placeholder' => 'Describe el cierre del viaje (opcional)',
              'required' => false,
          ]) ?>
          <button type="submit" class="btn btn-finalizar">Finalizar viaje</button>
        <?= $this->Form->end() ?>
      <?php else: ?>
        <p class="muted">Viaje finalizado.</p>
      <?php endif; ?>

      <hr class="card-divider">

      <?= $this->Form->create(null, ['class' => 'actions']) ?>
        <?= $this->Form->hidden('accion', ['value' => 'reportar_incidencia']) ?>
        <?= $this->Form->control('tipo_incidencia', [
            'type' => 'select',
            'label' => 'Tipo de incidencia',
            'options' => [
              'mecanica' => 'Mecánica',
                'trafico' => 'Tráfico',
              'clima' => 'Clima',
                'cliente' => 'Cliente',
              'otros' => 'Otros',
            ],
            'required' => true,
        ]) ?>
        <?= $this->Form->control('severidad', [
            'type' => 'select',
            'label' => 'Severidad',
            'options' => [
                'baja' => 'Baja',
                'media' => 'Media',
                'alta' => 'Alta',
                'critica' => 'Crítica',
            ],
            'default' => 'baja',
            'required' => true,
        ]) ?>
        <?= $this->Form->control('descripcion', [
            'type' => 'textarea',
            'label' => 'Descripción',
            'placeholder' => 'Describe la incidencia',
            'required' => true,
        ]) ?>
        <button type="submit" class="btn btn-incidencia">Reportar incidencia</button>
      <?= $this->Form->end() ?>
    </div>
  </div>
</section>

<script>
  window.xservHeaderConfig = {
    variant: 'driver',
    activePage: 'trips'
  };
</script>
<script src="/js/i18n.js"></script>
<script src="/js/header-loader.js"></script>
<script src="/js/header-dynamic.js"></script>

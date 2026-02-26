<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservChofere> $xservChoferes
 */
?>

<div class="xservChoferes chofers content">
    <div class="table-responsive">
        <div class="choferes-grid">
    <?php foreach ($xservChoferes as $chofer): ?>
        <div class="chofer-card">
            <div class="chofer-header">
                <span class="categoria"><?= h($chofer->categoria) ?></span>
                </div>
                <div class="chofer-body">
                    <div class="chofer-foto">
                        <img src="<?= h($chofer->foto_url) ?>" alt="<?= h($chofer->nombre) ?>">
                    </div>
                    <div class="chofer-info">
                        <h3><?= h($chofer->nombre) ?></h3>
                        <p>Edad: <?= h($chofer->edad) ?> años</p>
                        <p>Licencia: <?= h($chofer->tipo_licencia) ?></p>
                        <p>Unidad Asig.: <?= h($chofer->unidad_asig) ?></p>
                        <p>Experiencia: <?= h($chofer->experiencia) ?> años</p>
                    </div>
                </div>
                <div class="chofer-footer">
                    <p>Viajes: <?= h($chofer->viajes) ?></p>
                    <p>Incidentes: <?= h($chofer->incidentes) ?></p>
                    <p>Puntualidad: <?= h($chofer->puntualidad) ?>%</p>
                    <p>Calificación: <?= h($chofer->calificacion) ?> ★</p>
                    <p>ID: <?= h($chofer->id) ?></p>
                    <p>Estado: <?= h($chofer->estado) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    </div>

    <div class="paginator-container">
        <div class="paginator-buttons">
            <?= $this->Paginator->prev('← Anterior', ['class' => 'btn']) ?>
            <?= $this->Paginator->numbers(['class' => 'btn-number']) ?>
            <?= $this->Paginator->next('Siguiente →', ['class' => 'btn']) ?>
        </div>
        <div class="paginator-info">
            <?= $this->Paginator->counter(__('Página {{page}} de {{pages}}, mostrando {{current}} de {{count}} registros')) ?>
        </div>
    </div>


</div>

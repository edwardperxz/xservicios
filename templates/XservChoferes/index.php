<div class="xservChoferes lista content">
    <h3><?= __('Choferes Disponibles') ?></h3>

    <?php if (!empty($choferes)): ?>
        <ul class="choferes-list">
        <?php foreach ($choferes as $chofer): ?>
            <li class="chofer-card">
                <strong><?= h($chofer->nombre) ?></strong><br>
                Tel: <?= h($chofer->telefono) ?><br>
                Correo: <?= h($chofer->correo) ?><br>
                Licencia: <?= h($chofer->tipo_licencia) ?><br>
                Estado: <?= h($chofer->estado) ?> | Disponibilidad: <?= h($chofer->disponibilidad) ?>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p><?= __('No hay choferes disponibles.') ?></p>
    <?php endif; ?>
</div>

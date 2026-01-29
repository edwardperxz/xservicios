<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservValoracione $xservValoracione
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Xserv Valoracione'), ['action' => 'edit', $xservValoracione->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Xserv Valoracione'), ['action' => 'delete', $xservValoracione->id], ['confirm' => __('Are you sure you want to delete # {0}?', $xservValoracione->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Xserv Valoraciones'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Xserv Valoracione'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservValoraciones view content">
            <h3><?= h($xservValoracione->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Xserv Reserva') ?></th>
                    <td><?= $xservValoracione->hasValue('xserv_reserva') ? $this->Html->link($xservValoracione->xserv_reserva->codigo_reserva, ['controller' => 'XservReservas', 'action' => 'view', $xservValoracione->xserv_reserva->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Estado Moderacion') ?></th>
                    <td><?= h($xservValoracione->estado_moderacion) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($xservValoracione->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Calificacion') ?></th>
                    <td><?= $this->Number->format($xservValoracione->calificacion) ?></td>
                </tr>
                <tr>
                    <th><?= __('Puntuacion Limpieza') ?></th>
                    <td><?= $xservValoracione->puntuacion_limpieza === null ? '' : $this->Number->format($xservValoracione->puntuacion_limpieza) ?></td>
                </tr>
                <tr>
                    <th><?= __('Puntuacion Puntualidad') ?></th>
                    <td><?= $xservValoracione->puntuacion_puntualidad === null ? '' : $this->Number->format($xservValoracione->puntuacion_puntualidad) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($xservValoracione->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Mostrar En Web') ?></th>
                    <td><?= $xservValoracione->mostrar_en_web ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Comentarios') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($xservValoracione->comentarios)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservValoracion> $xservValoraciones
 */
?>
<div class="xservValoraciones index content">
    <?= $this->Html->link(__('New Xserv Valoracion'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Xserv Valoraciones') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('reserva_id') ?></th>
                    <th><?= $this->Paginator->sort('calificacion') ?></th>
                    <th><?= $this->Paginator->sort('puntuacion_limpieza') ?></th>
                    <th><?= $this->Paginator->sort('puntuacion_puntualidad') ?></th>
                    <th><?= $this->Paginator->sort('mostrar_en_web') ?></th>
                    <th><?= $this->Paginator->sort('estado_moderacion') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservValoraciones as $xservValoracione): ?>
                <tr>
                    <td><?= $this->Number->format($xservValoracione->id) ?></td>
                    <td><?= $xservValoracione->hasValue('xserv_reserva') ? $this->Html->link($xservValoracione->xserv_reserva->codigo_reserva, ['controller' => 'XservReservas', 'action' => 'view', $xservValoracione->xserv_reserva->id]) : '' ?></td>
                    <td><?= $this->Number->format($xservValoracione->calificacion) ?></td>
                    <td><?= $xservValoracione->puntuacion_limpieza === null ? '' : $this->Number->format($xservValoracione->puntuacion_limpieza) ?></td>
                    <td><?= $xservValoracione->puntuacion_puntualidad === null ? '' : $this->Number->format($xservValoracione->puntuacion_puntualidad) ?></td>
                    <td><?= h($xservValoracione->mostrar_en_web) ?></td>
                    <td><?= h($xservValoracione->estado_moderacion) ?></td>
                    <td><?= h($xservValoracione->created_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $xservValoracione->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $xservValoracione->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $xservValoracione->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $xservValoracione->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
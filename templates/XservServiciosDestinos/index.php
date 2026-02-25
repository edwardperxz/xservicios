<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservServicioDestino> $xservServiciosDestinos
 */
?>
<div class="xservServiciosDestinos index content">
    <?= $this->Html->link(__('New Xserv Servicio Destino'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Xserv Servicios Destinos') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('servicio_id') ?></th>
                    <th><?= $this->Paginator->sort('destino_id') ?></th>
                    <th><?= $this->Paginator->sort('orden_visita') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservServiciosDestinos as $xservServiciosDestino): ?>
                <tr>
                    <td><?= $xservServiciosDestino->hasValue('servicio') ? $this->Html->link($xservServiciosDestino->servicio->nombre, ['controller' => 'XservServicios', 'action' => 'view', $xservServiciosDestino->servicio->id]) : '' ?></td>
                    <td><?= $xservServiciosDestino->hasValue('destino') ? $this->Html->link($xservServiciosDestino->destino->id, ['controller' => 'XservDestinos', 'action' => 'view', $xservServiciosDestino->destino->id]) : '' ?></td>
                    <td><?= $xservServiciosDestino->orden_visita === null ? '' : $this->Number->format($xservServiciosDestino->orden_visita) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $xservServiciosDestino->servicio_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $xservServiciosDestino->servicio_id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $xservServiciosDestino->servicio_id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $xservServiciosDestino->servicio_id),
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
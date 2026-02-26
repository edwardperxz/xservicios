<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservReserva> $xservReservas
 */
?>
<div class="xservReservas index content">
    <?= $this->Html->link(__('New Xserv Reserva'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Xserv Reservas') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('codigo_reserva') ?></th>
                    <th><?= $this->Paginator->sort('cliente_id') ?></th>
                    <th><?= $this->Paginator->sort('servicio_id') ?></th>
                    <th><?= $this->Paginator->sort('ruta_id') ?></th>
                    <th><?= $this->Paginator->sort('fecha') ?></th>
                    <th><?= $this->Paginator->sort('hora') ?></th>
                    <th><?= $this->Paginator->sort('pasajeros') ?></th>
                    <th><?= $this->Paginator->sort('precio_pactado') ?></th>
                    <th><?= $this->Paginator->sort('itbms_pactado') ?></th>
                    <th><?= $this->Paginator->sort('punto_recogida') ?></th>
                    <th><?= $this->Paginator->sort('punto_destino') ?></th>
                    <th><?= $this->Paginator->sort('estado') ?></th>
                    <th><?= $this->Paginator->sort('estado_pago') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservReservas as $xservReserva): ?>
                <tr>
                    <td><?= $this->Number->format($xservReserva->id) ?></td>
                    <td><?= h($xservReserva->codigo_reserva) ?></td>
                    <td><?= $xservReserva->hasValue('cliente') ? $this->Html->link(($xservReserva->cliente?->usuario?->nombre ?? $xservReserva->cliente?->usuario?->username ?? 'Sin nombre'), ['controller' => 'XservClientes', 'action' => 'view', $xservReserva->cliente->id]) : '' ?></td>
                    <td><?= $xservReserva->hasValue('servicio') ? $this->Html->link($xservReserva->servicio->nombre, ['controller' => 'XservServicios', 'action' => 'view', $xservReserva->servicio->id]) : '' ?></td>
                    <td><?= $xservReserva->hasValue('ruta') ? $this->Html->link($xservReserva->ruta->id, ['controller' => 'XservRutas', 'action' => 'view', $xservReserva->ruta->id]) : '' ?></td>
                    <td><?= h($xservReserva->fecha) ?></td>
                    <td><?= h($xservReserva->hora) ?></td>
                    <td><?= $this->Number->format($xservReserva->pasajeros) ?></td>
                    <td><?= $this->Number->format($xservReserva->precio_pactado) ?></td>
                    <td><?= $xservReserva->itbms_pactado === null ? '' : $this->Number->format($xservReserva->itbms_pactado) ?></td>
                    <td><?= h($xservReserva->punto_recogida) ?></td>
                    <td><?= h($xservReserva->punto_destino) ?></td>
                    <td><?= h($xservReserva->estado) ?></td>
                    <td><?= h($xservReserva->estado_pago) ?></td>
                    <td><?= h($xservReserva->created_at) ?></td>
                    <td><?= h($xservReserva->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $xservReserva->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $xservReserva->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $xservReserva->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $xservReserva->id),
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
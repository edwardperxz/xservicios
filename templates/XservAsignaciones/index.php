<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservAsignacione> $xservAsignaciones
 */
?>
<div class="xservAsignaciones index content">
    <?= $this->Html->link(__('New Xserv Asignacione'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Xserv Asignaciones') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('reserva_id') ?></th>
                    <th><?= $this->Paginator->sort('chofer_id') ?></th>
                    <th><?= $this->Paginator->sort('vehiculo_id') ?></th>
                    <th><?= $this->Paginator->sort('asignado_por_id') ?></th>
                    <th><?= $this->Paginator->sort('fecha_inicio_pactada') ?></th>
                    <th><?= $this->Paginator->sort('fecha_fin_pactada') ?></th>
                    <th><?= $this->Paginator->sort('estado_asignacion') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservAsignaciones as $xservAsignacione): ?>
                <tr>
                    <td><?= $this->Number->format($xservAsignacione->id) ?></td>
                    <td><?= $xservAsignacione->hasValue('reserva') ? $this->Html->link($xservAsignacione->reserva->codigo_reserva, ['controller' => 'XservReservas', 'action' => 'view', $xservAsignacione->reserva->id]) : '' ?></td>
                    <?php
                    $choferNombre = null;
                    if ($xservAsignacione->hasValue('chofer')) {
                        $choferNombre = $xservAsignacione->chofer->usuario->nombre
                            ?? $xservAsignacione->chofer->usuario->username
                            ?? null;
                    }
                    ?>
                    <td><?= $choferNombre ? $this->Html->link($choferNombre, ['controller' => 'XservChoferes', 'action' => 'view', $xservAsignacione->chofer->id]) : '' ?></td>
                    <td><?= $xservAsignacione->hasValue('vehiculo') ? $this->Html->link($xservAsignacione->vehiculo->tipo, ['controller' => 'XservVehiculos', 'action' => 'view', $xservAsignacione->vehiculo->id]) : '' ?></td>
                    <td><?= $xservAsignacione->hasValue('asignado_por') ? $this->Html->link($xservAsignacione->asignado_por->username, ['controller' => 'XservUsuarios', 'action' => 'view', $xservAsignacione->asignado_por->id]) : '' ?></td>
                    <td><?= h($xservAsignacione->fecha_inicio_pactada) ?></td>
                    <td><?= h($xservAsignacione->fecha_fin_pactada) ?></td>
                    <td><?= h($xservAsignacione->estado_asignacion) ?></td>
                    <td><?= h($xservAsignacione->created_at) ?></td>
                    <td><?= h($xservAsignacione->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $xservAsignacione->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $xservAsignacione->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $xservAsignacione->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $xservAsignacione->id),
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
<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservVehiculo> $xservVehiculos
 */
?>
<div class="xservVehiculos index content">
    <?= $this->Html->link(__('New Xserv Vehiculo'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Xserv Vehiculos') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('tipo') ?></th>
                    <th><?= $this->Paginator->sort('nombre_unidad') ?></th>
                    <th><?= $this->Paginator->sort('capacidad_max') ?></th>
                    <th><?= $this->Paginator->sort('placa') ?></th>
                    <th><?= $this->Paginator->sort('anio') ?></th>
                    <th><?= $this->Paginator->sort('kilometraje_actual') ?></th>
                    <th><?= $this->Paginator->sort('estado_operativo') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservVehiculos as $xservVehiculo): ?>
                <tr>
                    <td><?= $this->Number->format($xservVehiculo->id) ?></td>
                    <td><?= h($xservVehiculo->tipo) ?></td>
                    <td><?= h($xservVehiculo->nombre_unidad) ?></td>
                    <td><?= $this->Number->format($xservVehiculo->capacidad_max) ?></td>
                    <td><?= h($xservVehiculo->placa) ?></td>
                    <td><?= $xservVehiculo->anio === null ? '' : $this->Number->format($xservVehiculo->anio) ?></td>
                    <td><?= $xservVehiculo->kilometraje_actual === null ? '' : $this->Number->format($xservVehiculo->kilometraje_actual) ?></td>
                    <td><?= h($xservVehiculo->estado_operativo) ?></td>
                    <td><?= h($xservVehiculo->created_at) ?></td>
                    <td><?= h($xservVehiculo->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $xservVehiculo->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $xservVehiculo->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $xservVehiculo->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $xservVehiculo->id),
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
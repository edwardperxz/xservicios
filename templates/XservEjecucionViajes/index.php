<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservEjecucionViaje> $xservEjecucionViajes
 */
?>
<div class="xservEjecucionViajes index content">
    <?= $this->Html->link(__('New Xserv Ejecucion Viaje'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Xserv Ejecucion Viajes') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('asignacion_id') ?></th>
                    <th><?= $this->Paginator->sort('hora_inicio_real') ?></th>
                    <th><?= $this->Paginator->sort('hora_fin_real') ?></th>
                    <th><?= $this->Paginator->sort('km_inicio') ?></th>
                    <th><?= $this->Paginator->sort('km_fin') ?></th>
                    <th><?= $this->Paginator->sort('lat_inicio') ?></th>
                    <th><?= $this->Paginator->sort('lng_inicio') ?></th>
                    <th><?= $this->Paginator->sort('lat_fin') ?></th>
                    <th><?= $this->Paginator->sort('lng_fin') ?></th>
                    <th><?= $this->Paginator->sort('estado_ejecucion') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservEjecucionViajes as $xservEjecucionViaje): ?>
                <tr>
                    <td><?= $this->Number->format($xservEjecucionViaje->id) ?></td>
                    <td><?= $xservEjecucionViaje->hasValue('asignacion') ? $this->Html->link($xservEjecucionViaje->asignacion->id, ['controller' => 'XservAsignaciones', 'action' => 'view', $xservEjecucionViaje->asignacion->id]) : '' ?></td>
                    <td><?= h($xservEjecucionViaje->hora_inicio_real) ?></td>
                    <td><?= h($xservEjecucionViaje->hora_fin_real) ?></td>
                    <td><?= $xservEjecucionViaje->km_inicio === null ? '' : $this->Number->format($xservEjecucionViaje->km_inicio) ?></td>
                    <td><?= $xservEjecucionViaje->km_fin === null ? '' : $this->Number->format($xservEjecucionViaje->km_fin) ?></td>
                    <td><?= $xservEjecucionViaje->lat_inicio === null ? '' : $this->Number->format($xservEjecucionViaje->lat_inicio) ?></td>
                    <td><?= $xservEjecucionViaje->lng_inicio === null ? '' : $this->Number->format($xservEjecucionViaje->lng_inicio) ?></td>
                    <td><?= $xservEjecucionViaje->lat_fin === null ? '' : $this->Number->format($xservEjecucionViaje->lat_fin) ?></td>
                    <td><?= $xservEjecucionViaje->lng_fin === null ? '' : $this->Number->format($xservEjecucionViaje->lng_fin) ?></td>
                    <td><?= h($xservEjecucionViaje->estado_ejecucion) ?></td>
                    <td><?= h($xservEjecucionViaje->created_at) ?></td>
                    <td><?= h($xservEjecucionViaje->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $xservEjecucionViaje->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $xservEjecucionViaje->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $xservEjecucionViaje->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $xservEjecucionViaje->id),
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
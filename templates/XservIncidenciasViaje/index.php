<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservIncidenciasViaje> $xservIncidenciasViaje
 */
?>
<div class="xservIncidenciasViaje index content">
    <?= $this->Html->link(__('New Xserv Incidencias Viaje'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Xserv Incidencias Viaje') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('ejecucion_id') ?></th>
                    <th><?= $this->Paginator->sort('tipo_incidencia') ?></th>
                    <th><?= $this->Paginator->sort('latitud_incidencia') ?></th>
                    <th><?= $this->Paginator->sort('longitud_incidencia') ?></th>
                    <th><?= $this->Paginator->sort('severidad') ?></th>
                    <th><?= $this->Paginator->sort('resuelto') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservIncidenciasViaje as $xservIncidenciasViaje): ?>
                <tr>
                    <td><?= $this->Number->format($xservIncidenciasViaje->id) ?></td>
                    <td><?= $xservIncidenciasViaje->hasValue('ejecucion') ? $this->Html->link($xservIncidenciasViaje->ejecucion->id, ['controller' => 'XservEjecucionViajes', 'action' => 'view', $xservIncidenciasViaje->ejecucion->id]) : '' ?></td>
                    <td><?= h($xservIncidenciasViaje->tipo_incidencia) ?></td>
                    <td><?= $xservIncidenciasViaje->latitud_incidencia === null ? '' : $this->Number->format($xservIncidenciasViaje->latitud_incidencia) ?></td>
                    <td><?= $xservIncidenciasViaje->longitud_incidencia === null ? '' : $this->Number->format($xservIncidenciasViaje->longitud_incidencia) ?></td>
                    <td><?= h($xservIncidenciasViaje->severidad) ?></td>
                    <td><?= h($xservIncidenciasViaje->resuelto) ?></td>
                    <td><?= h($xservIncidenciasViaje->created_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $xservIncidenciasViaje->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $xservIncidenciasViaje->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $xservIncidenciasViaje->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $xservIncidenciasViaje->id),
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
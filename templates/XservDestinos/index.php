<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservDestino> $xservDestinos
 */
?>
<div class="xservDestinos index content">
    <?= $this->Html->link(__('New Xserv Destino'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Xserv Destinos') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('ubicacion_id') ?></th>
                    <th><?= $this->Paginator->sort('es_popular') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservDestinos as $xservDestino): ?>
                <tr>
                    <td><?= $this->Number->format($xservDestino->id) ?></td>
                    <td><?= $xservDestino->hasValue('ubicacion') ? $this->Html->link($xservDestino->ubicacion->nombre, ['controller' => 'XservUbicaciones', 'action' => 'view', $xservDestino->ubicacion->id]) : '' ?></td>
                    <td><?= h($xservDestino->es_popular) ?></td>
                    <td><?= h($xservDestino->created_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $xservDestino->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $xservDestino->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $xservDestino->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $xservDestino->id),
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
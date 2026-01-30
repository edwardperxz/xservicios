<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservRuta> $xservRutas
 */
?>
<div class="xservRutas index content">
    <?= $this->Html->link(__('New Xserv Ruta'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Xserv Rutas') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('origen_id') ?></th>
                    <th><?= $this->Paginator->sort('destino_id') ?></th>
                    <th><?= $this->Paginator->sort('precio_base') ?></th>
                    <th><?= $this->Paginator->sort('tiempo_estimado_min') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservRutas as $xservRuta): ?>
                <tr>
                    <td><?= $this->Number->format($xservRuta->id) ?></td>
                    <td><?= $xservRuta->hasValue('origen') ? $this->Html->link($xservRuta->origen->nombre, ['controller' => 'XservUbicaciones', 'action' => 'view', $xservRuta->origen->id]) : '' ?></td>
                    <td><?= $xservRuta->hasValue('destino') ? $this->Html->link($xservRuta->destino->nombre, ['controller' => 'XservUbicaciones', 'action' => 'view', $xservRuta->destino->id]) : '' ?></td>
                    <td><?= $this->Number->format($xservRuta->precio_base) ?></td>
                    <td><?= $xservRuta->tiempo_estimado_min === null ? '' : $this->Number->format($xservRuta->tiempo_estimado_min) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $xservRuta->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $xservRuta->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $xservRuta->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $xservRuta->id),
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
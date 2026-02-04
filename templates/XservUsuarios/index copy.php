<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservUsuario> $xservUsuarios
 */
?>
<div class="xservUsuarios index content">
    <?= $this->Html->link(__('New Xserv Usuario'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Xserv Usuarios') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('username') ?></th>
                    <th><?= $this->Paginator->sort('rol') ?></th>
                    <th><?= $this->Paginator->sort('estado') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservUsuarios as $xservUsuario): ?>
                <tr>
                    <td><?= $this->Number->format($xservUsuario->id) ?></td>
                    <td><?= h($xservUsuario->username) ?></td>
                    <td><?= h($xservUsuario->rol) ?></td>
                    <td><?= h($xservUsuario->estado) ?></td>
                    <td><?= h($xservUsuario->created_at) ?></td>
                    <td><?= h($xservUsuario->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $xservUsuario->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $xservUsuario->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $xservUsuario->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $xservUsuario->id),
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
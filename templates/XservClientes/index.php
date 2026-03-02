<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservCliente> $xservClientes
 */
?>
<div class="xservClientes index content">
    <?= $this->Html->link(__('New Xserv Cliente'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Xserv Clientes') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('XservUsuarios.username', 'Usuario') ?></th>
                    <th><?= $this->Paginator->sort('XservUsuarios.nombre', 'Nombre') ?></th>
                    <th><?= $this->Paginator->sort('identificacion_fiscal') ?></th>
                    <th><?= $this->Paginator->sort('idioma_preferido') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservClientes as $xservCliente): ?>
                <?php $usuario = $xservCliente->usuario ?? null; ?>
                <?php $username = $usuario->username ?? null; ?>
                <?php $nombre = $usuario->nombre ?? null; ?>
                <tr>
                    <td><?= $this->Number->format($xservCliente->id) ?></td>
                    <td><?= $usuario && $username !== null && $username !== '' ? h($username) : 'Sin usuario' ?></td>
                    <td><?= $nombre !== null && $nombre !== '' ? h($nombre) : 'Sin nombre' ?></td>
                    <td><?= h($xservCliente->identificacion_fiscal) ?></td>
                    <td><?= h($xservCliente->idioma_preferido) ?></td>
                    <td><?= h($xservCliente->created_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $xservCliente->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $xservCliente->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $xservCliente->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $xservCliente->id),
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
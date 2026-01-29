<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservNotificacione> $xservNotificaciones
 */
?>
<div class="xservNotificaciones index content">
    <?= $this->Html->link(__('New Xserv Notificacione'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Xserv Notificaciones') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('usuario_id') ?></th>
                    <th><?= $this->Paginator->sort('cliente_id') ?></th>
                    <th><?= $this->Paginator->sort('reserva_id') ?></th>
                    <th><?= $this->Paginator->sort('tipo_notificacion') ?></th>
                    <th><?= $this->Paginator->sort('medio') ?></th>
                    <th><?= $this->Paginator->sort('destinatario') ?></th>
                    <th><?= $this->Paginator->sort('estado_envio') ?></th>
                    <th><?= $this->Paginator->sort('enviado_at') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservNotificaciones as $xservNotificacione): ?>
                <tr>
                    <td><?= $this->Number->format($xservNotificacione->id) ?></td>
                    <td><?= $xservNotificacione->hasValue('usuario') ? $this->Html->link($xservNotificacione->usuario->username, ['controller' => 'XservUsuarios', 'action' => 'view', $xservNotificacione->usuario->id]) : '' ?></td>
                    <td><?= $xservNotificacione->hasValue('cliente') ? $this->Html->link($xservNotificacione->cliente->nombre, ['controller' => 'XservClientes', 'action' => 'view', $xservNotificacione->cliente->id]) : '' ?></td>
                    <td><?= $xservNotificacione->hasValue('reserva') ? $this->Html->link($xservNotificacione->reserva->codigo_reserva, ['controller' => 'XservReservas', 'action' => 'view', $xservNotificacione->reserva->id]) : '' ?></td>
                    <td><?= h($xservNotificacione->tipo_notificacion) ?></td>
                    <td><?= h($xservNotificacione->medio) ?></td>
                    <td><?= h($xservNotificacione->destinatario) ?></td>
                    <td><?= h($xservNotificacione->estado_envio) ?></td>
                    <td><?= h($xservNotificacione->enviado_at) ?></td>
                    <td><?= h($xservNotificacione->created_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $xservNotificacione->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $xservNotificacione->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $xservNotificacione->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $xservNotificacione->id),
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
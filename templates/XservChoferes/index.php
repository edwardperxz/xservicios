<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservChofere> $xservChoferes
 */
?>
<div class="xservChoferes index content">
    <?= $this->Html->link(__('New Xserv Chofere'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Xserv Choferes') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('usuario_id') ?></th>
                    <th><?= $this->Paginator->sort('nombre') ?></th>
                    <th><?= $this->Paginator->sort('identificacion') ?></th>
                    <th><?= $this->Paginator->sort('telefono') ?></th>
                    <th><?= $this->Paginator->sort('correo') ?></th>
                    <th><?= $this->Paginator->sort('estado') ?></th>
                    <th><?= $this->Paginator->sort('fecha_ingreso') ?></th>
                    <th><?= $this->Paginator->sort('tipo_licencia') ?></th>
                    <th><?= $this->Paginator->sort('disponibilidad') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservChoferes as $xservChofere): ?>
                <tr>
                    <td><?= $this->Number->format($xservChofere->id) ?></td>
                    <td><?= $xservChofere->hasValue('usuario') ? $this->Html->link($xservChofere->usuario->username, ['controller' => 'XservUsuarios', 'action' => 'view', $xservChofere->usuario->id]) : '' ?></td>
                    <td><?= h($xservChofere->nombre) ?></td>
                    <td><?= h($xservChofere->identificacion) ?></td>
                    <td><?= h($xservChofere->telefono) ?></td>
                    <td><?= h($xservChofere->correo) ?></td>
                    <td><?= h($xservChofere->estado) ?></td>
                    <td><?= h($xservChofere->fecha_ingreso) ?></td>
                    <td><?= h($xservChofere->tipo_licencia) ?></td>
                    <td><?= h($xservChofere->disponibilidad) ?></td>
                    <td><?= h($xservChofere->created_at) ?></td>
                    <td><?= h($xservChofere->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $xservChofere->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $xservChofere->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $xservChofere->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $xservChofere->id),
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